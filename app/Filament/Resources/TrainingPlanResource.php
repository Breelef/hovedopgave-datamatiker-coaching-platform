<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrainingPlanResource\Pages;
use App\Filament\Resources\TrainingPlanResource\RelationManagers;
use App\Models\AgeGroup;
use App\Models\TrainingPlan;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TrainingPlanResource extends Resource
{
    protected static ?string $model = TrainingPlan::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationGroup = 'Træningsplaner';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Select::make('type')
                    ->options([
                        'football' => 'Football',
                        'fitness' => 'Fitness',
                        'mental' => 'Mental',
                    ])->live(),
                Select::make('age_group_id')
                    ->label('Aldersgruppe')
                    ->options(AgeGroup::all()->pluck('name', 'id')),
                Forms\Components\TextInput::make('name')
                    ->label('Navn')
                    ->placeholder('Eks. Periodisering Brøndby IF U10-U12. 1. halvår')
                    ->required()
                    ->maxLength(255)
                    ->autocomplete(false)
                    ->columnSpanFull(),
                //                Forms\Components\Section::make('Perioder')
                //                    ->description('Tilføj perioder til din træningsplan')
                //                    ->schema([
                //                        Forms\Components\Repeater::make('sessionGroups')
                //                            ->label('Perioder')
                //                            ->relationship()
                //                            ->schema([
                //                                Forms\Components\TextInput::make('period')
                //                                    ->label('Periode Længde')
                //                                    ->required()
                //                                    ->maxLength(255),
                //                                Forms\Components\TextInput::make('theme')
                //                                    ->label('Navn')
                //                                    ->placeholder('Eks. Gennembrudsspil')
                //                                    ->required()
                //                                    ->maxLength(255),
                //                                Forms\Components\Section::make('Trænings Sessioner')
                //                                    ->description('Tilføj trænings sessioner til dine perioder')
                //                                    ->schema([
                //                                        Forms\Components\Repeater::make('trainingSessions')
                //                                            ->label('Trænings Sessioner')
                //                                            ->relationship()
                //                                            ->schema([
                //                                                Forms\Components\TextInput::make('name')
                //                                                    ->label('Navn')
                //                                                    ->placeholder('Eks. Dag 1')
                //                                                    ->required()
                //                                                    ->maxLength(255),
                //                                                Forms\Components\Section::make('Øvelser')
                //                                                    ->description('Tilføj øvelser til dine trænings sessioner')
                //                                                    ->schema([
                //                                                        Forms\Components\Repeater::make('trainingSessionExercises')
                //                                                            ->label('Øvelser til trænings sessioner')
                //                                                            ->relationship()
                //                                                            ->reorderable()
                //                                                            ->schema([
                //                                                                Forms\Components\Select::make('exercise_id')
                //                                                                    ->label('Øvelser')
                //                                                                    ->relationship('exercise', 'name')
                //                                                                    ->searchable()
                //                                                            ])
                //                                                            ->addActionLabel('Tilføj øvelse til træningssession'),
                //                                                    ]),
                //
                //                                            ])
                //                                            ->addActionLabel('Tilføj træningssession'),
                //                                    ]),
                //
                //                            ])
                //                            ->columnSpanFull()
                //                            ->addActionLabel('Tilføj træningsperiode'),
                //                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('name')
                    ->label('Navn')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ageGroup.name')
                    ->label('Aldersgruppe')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Type')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
            RelationManagers\SessionGroupsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTrainingPlans::route('/'),
            'create' => Pages\CreateTrainingPlan::route('/create'),
            'edit' => Pages\EditTrainingPlan::route('/{record}/edit'),
        ];
    }
}

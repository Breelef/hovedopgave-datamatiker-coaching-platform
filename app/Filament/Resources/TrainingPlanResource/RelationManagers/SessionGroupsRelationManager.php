<?php

namespace App\Filament\Resources\TrainingPlanResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class SessionGroupsRelationManager extends RelationManager
{
    protected static string $relationship = 'sessionGroups';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('starts_at')
                    ->label('Trænings Periode Start')
                    ->required(),
                Forms\Components\DatePicker::make('ends_at')
                    ->label('Trænings Periode Slut'),
                Forms\Components\TextInput::make('name')
                    ->label('Navn')
                    ->placeholder('Eks. Gennembrudsspil')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Section::make('Trænings Sessioner')
                    ->description('Tilføj trænings sessioner til din periode')
                    ->schema([
                        Forms\Components\Repeater::make('trainingSessions')
                            ->label('')
                            ->relationship()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Navn')
                                    ->placeholder('Eks. Dag 1')
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpanFull(),
                                Forms\Components\Section::make('Øvelser')
                                    ->description('Tilføj øvelser til dine trænings sessioner')
                                    ->schema([
                                        Forms\Components\Repeater::make('trainingSessionExercises')
                                            ->label('Øvelser til trænings sessioner')
                                            ->relationship()
                                            ->reorderable()
                                            ->schema([
                                                Forms\Components\Select::make('exercise_id')
                                                    ->label('Øvelser')
                                                    ->relationship('exercise', 'name')
                                                    ->getOptionLabelFromRecordUsing(function ($record) {
                                                        return "{$record->name} - {$record->activity_type}";
                                                    })
                                                    ->searchable(),
                                                Forms\Components\TextInput::make('duration')
                                                    ->label('Længde for øvelsen')
                                                    ->numeric()
                                                    ->required(),
                                            ])
                                            ->live()->addActionLabel('Tilføj øvelse til træningssession'),
                                    ]),

                            ])
                            ->addActionLabel('Tilføj træningssessioner'),
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('duration_as_week_string')
                    ->label('Længde for sessions gruppe'),
                Tables\Columns\TextColumn::make('name')
                    ->label('Fokus for perioden'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
}

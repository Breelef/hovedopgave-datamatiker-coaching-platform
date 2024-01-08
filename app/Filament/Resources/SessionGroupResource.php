<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SessionGroupResource\Pages;
use App\Filament\Resources\SessionGroupResource\RelationManagers;
use App\Models\SessionGroup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SessionGroupResource extends Resource
{
    protected static ?string $model = SessionGroup::class;

    protected static ?string $navigationIcon = 'heroicon-o-queue-list';

    protected static ?string $navigationGroup = 'Træningsplaner';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('starts_at')
                    ->label('Trænings Periode Start')
                    ->required(),
                Forms\Components\DatePicker::make('ends_at')
                    ->label('Trænings Periode Slut'),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('trainingplan.name')
                    ->label('Træningsplan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('trainingplan.ageGroup.name')
                    ->label('Aldersgruppe')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('duration_as_week_string')
                    ->label('Periode')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Navn')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            RelationManagers\TrainingSessionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSessionGroups::route('/'),
            'create' => Pages\CreateSessionGroup::route('/create'),
            'edit' => Pages\EditSessionGroup::route('/{record}/edit'),
        ];
    }
}

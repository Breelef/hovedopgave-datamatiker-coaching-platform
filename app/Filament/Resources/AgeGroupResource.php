<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AgeGroupResource\Pages;
use App\Filament\Resources\AgeGroupResource\RelationManagers\TeamsRelationManager;
use App\Models\AgeGroup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AgeGroupResource extends Resource
{
    protected static ?string $model = AgeGroup::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';

    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->autocomplete(false)
                    ->maxLength(100),
                Forms\Components\TextInput::make('age')
                    ->label('Age')
                    ->numeric()
                    ->step(1)
                    ->minValue(1)
                    ->maxValue(99)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            //
            TeamsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAgeGroups::route('/'),
            'create' => Pages\CreateAgeGroup::route('/create'),
            'edit' => Pages\EditAgeGroup::route('/{record}/edit'),
        ];
    }
}

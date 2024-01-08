<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClubResource\Pages;
use App\Models\Club;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;

class ClubResource extends Resource
{
    protected static ?string $model = Club::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    protected static ?string $navigationGroup = 'Klub';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Description')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->autocomplete(false)
                            ->maxLength(100),
                        Forms\Components\TextInput::make('website')
                            ->url()
                            ->autocomplete(false)
                            ->maxLength(100),
                        Forms\Components\ColorPicker::make('theme_settings.primary_color'),
                        Forms\Components\ColorPicker::make('theme_settings.primary_color_hover'),
                        Forms\Components\ColorPicker::make('theme_settings.secondary_color'),
                        Forms\Components\FileUpload::make('logo')
                            ->image(),
                        Forms\Components\Toggle::make('is_active')
                            ->default(1)
                            ->required(),
                    ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Navn')
                    ->searchable(),
                Tables\Columns\TextColumn::make('website')
                    ->label('Hjemmeside'),
                Tables\Columns\ImageColumn::make('logo'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('delete')
                    ->requiresConfirmation()
                    ->action(fn (Club $record) => $record->delete()),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->paginated(['all']);
    }

    public static function getRelations(): array
    {
        return [
            //
            ClubResource\RelationManagers\TeamsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClubs::route('/'),
            'create' => Pages\CreateClub::route('/create'),
            'edit' => Pages\EditClub::route('/{record}/edit'),
        ];
    }
}

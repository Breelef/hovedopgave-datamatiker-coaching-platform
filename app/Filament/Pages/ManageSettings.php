<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSettings;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageSettings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = GeneralSettings::class;

    protected static ?string $navigationGroup = 'Settings';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Theme Settings')
                    ->schema([
                        \Filament\Forms\Components\ColorPicker::make('theme_primary_color'),
                        \Filament\Forms\Components\ColorPicker::make('theme_primary_color_hover'),
                        \Filament\Forms\Components\ColorPicker::make('theme_secondary_color'),
                    ]),
            ]);
    }
}

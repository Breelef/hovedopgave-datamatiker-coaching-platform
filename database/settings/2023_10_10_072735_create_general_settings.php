<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.theme_primary_color', '#071F56');
        $this->migrator->add('general.theme_primary_color_hover', '#0a2f7e');
        $this->migrator->add('general.theme_secondary_color', '#FFDB57');
    }
};

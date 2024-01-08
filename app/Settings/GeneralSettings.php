<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public $theme_primary_color;

    public $theme_primary_color_hover;

    public $theme_secondary_color;

    public static function group(): string
    {
        return 'general';
    }
}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
        <style type="text/css">
            .bg-vestegns-deep-blues { background-color: {{ app(App\Settings\GeneralSettings::class)->theme_primary_color }} !important }

            .bg-primary-color { background-color: {{ app(App\Settings\GeneralSettings::class)->theme_primary_color }} !important }
            .bg-primary-color-hover:hover { background-color: {{ app(App\Settings\GeneralSettings::class)->theme_primary_color_hover }} !important }
            .bg-primary-color-hover-bg { background-color: {{ app(App\Settings\GeneralSettings::class)->theme_primary_color_hover }} !important }
            .text-primary-color { color: {{ app(App\Settings\GeneralSettings::class)->theme_primary_color }} !important }
            .bg-secondary-color { background-color: {{ app(App\Settings\GeneralSettings::class)->theme_secondary_color }} !important }
            .text-secondary-color { color: {{ app(App\Settings\GeneralSettings::class)->theme_secondary_color }} !important }
            .border-secondary-color { border-color: {{ app(App\Settings\GeneralSettings::class)->theme_secondary_color }} !important }
        </style>
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>

        @livewireScripts
    </body>
</html>

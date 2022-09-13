<?php

namespace Coderflex\LaravelCsv;

class LaravelCsvDirectives
{
    public static function csvStyles()
    {
        if (config('laravel_csv.layout') == 'tailwindcss') {
            return self::getTailwindStyle();
        }
    }

    public static function csvScripts()
    {
        return <<<HTML
            <script src="{{ asset('vendor/csv/js/app.js') }}"></script>
        HTML;
    }

    protected static function getTailwindStyle()
    {
        return <<<HTML
                <link href="{{ asset('vendor/csv/css/tailwind.css') }}" rel="stylesheet"></link>
        HTML;
    }
}
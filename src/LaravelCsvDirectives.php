<?php

namespace Coderflex\LaravelCsv;

class LaravelCsvDirectives
{
    /**
     * Get CSV Styles
     * 
     * @return string
     */
    public static function csvStyles():string|null
    {
        if (config('laravel_csv.layout') == 'tailwindcss') {
            return self::getTailwindStyle();
        }

        return self::getTailwindStyle();
    }

    /**
     * Get CSV Scripts
     * 
     * @return string
     */
    public static function csvScripts(): string
    {
        return <<<'HTML'
            <script src="{{ asset('vendor/csv/js/app.js') }}"></script>
        HTML;
    }

    /**
     * Get Tailwind Style Path
     * 
     * @return string
     */
    protected static function getTailwindStyle(): string
    {
        return <<<'HTML'
                <link href="{{ asset('vendor/csv/css/tailwind.css') }}" rel="stylesheet"></link>
        HTML;
    }
}

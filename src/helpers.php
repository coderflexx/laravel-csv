<?php

namespace Coderflex\LaravelCsv;

if (! function_exists('Coderflex\LaravelCsv\csv_view_path')) {
    /**
     * Get the evaluated view content from the livewire view
     *
     * @param  string|null  $view
     * @return string
     */
    function csv_view_path(string|null $view): string
    {
        if(file_exists(__DIR__ . '/../../../../resources/views/vendor/csv/livewire/'.config('laravel_csv.layout')))
        {
            return 'vendor/csv/livewire/.'.config('laravel_csv.layout').'.'.$view;
        }
        return 'laravel-csv::livewire.'.config('laravel_csv.layout').'.'.$view;
    }
}

<?php

namespace Coderflex\LaravelCsv;

class LaravelCsvManager
{
    /**
     * Get the given size and formated it.
     *
     * @param  int  $number
     * @param  int  $precision
     * @return string
     */
    public function formatFileSize(int $size, int $precision = 2): string
    {
        if ($size <= 0) {
            return $size;
        }

        $base = log((int) $size) / log(1024);
        $suffixes = ['KB', 'MB', 'GB', 'TB'];

        return round(
            pow(1024, $base - floor($base)), $precision
        ).$suffixes[floor($base)];
    }
}

<?php

namespace Coderflex\LaravelCsv\Concerns;

trait InteractsWithColumns
{
    /**
     * Converts the columnsToMap property into an associative array.
     *
     * @param  array  $columnsToMap
     * @return array
     */
    protected function mapThroughColumns(): array
    {
        if (! $this->columnsToMap) {
            return [];
        }

        return collect($this->columnsToMap)
                ->mapWithKeys(fn ($column): array => [$column => ''])
                ->toArray();
    }

    /**
     * Maps requiredColumns property into columnsToMap required state.
     *
     * @param  array  $requiredColumns
     * @return array
     */
    protected function mapThroughRequiredColumns(): array
    {
        if (! $this->requiredColumns) {
            return [];
        }

        $this->requiredColumns = collect($this->requiredColumns)
            ->mapWithKeys(function ($column): array {
                return ['columnsToMap.'.$column => 'required'];
            })->toArray();

        return $this->requiredColumns;
    }

    /**
     * Maps columnLabels property into columnsToMap label state.
     *
     * @param  array  $columnLabels
     * @return array
     */
    protected function mapThroughColumnLabels(): array
    {
        if (! $this->columnLabels) {
            return [];
        }

        return collect($this->requiredColumns)
                ->mapWithKeys(function ($column): array {
                    return [
                        'columnsToMap.'.$column => strtolower($this->columnLabels[$column]),
                    ];
                })->toArray();
    }
}

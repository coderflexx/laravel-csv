<?php

namespace Coderflex\LaravelCsv\Utilities;

use Generator;
use Iterator;

/**
 * ChunkIterator is simple class, using built-in Iterator php class.
 * The use cases of this generator class is to avoid memory limit, that
 * requires a considerable amount of processing time to generate.
 * Instead of excuting directly in-memory, we yeild the results as
 * many times as we need.
 *
 * @see https://www.php.net/manual/en/language.generators.overview.php
 * @see https://www.php.net/manual/en/language.generators.syntax.php#control-structures.yield
 * @see https://www.php.net/manual/en/language.oop5.iterations.php
 */
class ChunkIterator
{
    /**
     * @var Iterator
     */
    protected Iterator $iterator;

    /**
     * @var int
     */
    protected int $chunkSize;

    public function __construct(Iterator $iterator, int $chunkSize)
    {
        $this->iterator = $iterator;
        $this->chunkSize = $chunkSize;
    }

    /**
     * Chunk the given data
     * 
     * @return Generator
     */
    public function get(): Generator
    {
        $chunk = [];

        for ($i = 0; $this->iterator->valid(); $i++) {
            // store the current record into the $chunk array
            $chunk[] = $this->iterator->current();

            // move on to the next record
            $this->iterator->next();

            // if the number of element on the $chunk variable
            // met the chunk size, we yield the result and start
            // over, to the next elements
            if (count($chunk) == $this->chunkSize) {
                yield $chunk;
                $chunk = [];
            }
        }

        // if the chunk size is positive, we yield the results
        if (count($chunk) > 0) {
            yield $chunk;
        }
    }
}

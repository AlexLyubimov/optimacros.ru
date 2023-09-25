<?php

namespace Optimacros\App\Console;

use Exception;
use Optimacros\App\Contracts\Readable;
use Optimacros\App\Contracts\Writable;
use Optimacros\App\JsonEncoder;
use Optimacros\App\ListItem;
use Optimacros\App\SimpleTreeBuilder;

class BuildTreeCommand
{
    public function __construct(
        private readonly Readable          $readable,
        private readonly Writable          $writable,
        private readonly JsonEncoder       $encoder,
        private readonly SimpleTreeBuilder $builder,
    ) {

    }

    public function handle(string $inputPath, string $outputPath): void
    {
        try {
            $flattenCollection = $this->mapData($this->readable->read($inputPath));

            $hierarchicalCollection = $this->builder->build($flattenCollection);

            $this->writable->write($outputPath, $this->encoder->encode($hierarchicalCollection));
        } catch (Exception $e) {
            print_r('ERROR! ' . $e->getMessage() . PHP_EOL);
            exit(1);
        }
    }

    /**
     * @param array $data
     * @return array<ListItem>
     */
    private function mapData(array $data): array
    {
        $collection = [];

        foreach ($data as $item) {
            $collection[] = new ListItem(
                id: $item[0],
                type: $item[1],
                parentId: $item[2] === '' ? null : $item[2],
                relation: $item[3],
            );
        }

        return $collection;
    }
}

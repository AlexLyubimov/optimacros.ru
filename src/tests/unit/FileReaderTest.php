<?php

namespace UnitTests\Optimacros;

use Optimacros\App\Exceptions\FileNotFoundException;
use Optimacros\App\Filesystem\FileReader;
use Optimacros\App\ListItem;
use PHPUnit\Framework\TestCase;

class FileReaderTest extends TestCase
{
    private const PATH = __DIR__ . '/../_data/short_input.csv';

    /**
     * @throws FileNotFoundException
     */
    public function testSuccess(): void
    {
        $collection = (new FileReader())->read(self::PATH);

        $expected = [
            ['Total', ListItem::TYPE_BASE, null, null],
            ['ПВЛ', ListItem::TYPE_BASE, 'Total', null],
            ['Стандарт.#1', ListItem::TYPE_OPTIONS, 'ПВЛ', null],
            ['Тележка Б25.#2', ListItem::TYPE_DIRECT, 'Стандарт.#1', 'Тележка Б25'],
            ['Доп1.#113', ListItem::TYPE_OPTIONS, null, null],
            ['Тележка Б25.#255', ListItem::TYPE_DIRECT, 'Доп1.#113', 'Тележка Б25'],
        ];

        self::assertEquals($expected, $collection);
    }

    public function testFileNotExists(): void
    {
        $this->expectException(FileNotFoundException::class);

        (new FileReader())->read('some path');
    }
}

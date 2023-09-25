<?php

namespace UnitTests\Optimacros;

use Optimacros\App\ListItem;
use Optimacros\App\SimpleTreeBuilder;
use PHPUnit\Framework\TestCase;

class TreeBuilderTest extends TestCase
{
    public function testSuccess(): void
    {
        $collection = [
            new ListItem('Total', ListItem::TYPE_BASE, null, null),
            new ListItem('ПВЛ', ListItem::TYPE_BASE, 'Total', null),
            new ListItem('Стандарт.#1', ListItem::TYPE_OPTIONS, 'ПВЛ', null),
            new ListItem('Тележка Б25.#2', ListItem::TYPE_DIRECT, 'Стандарт.#1', 'Тележка Б25'),
            new ListItem('Доп1.#113', ListItem::TYPE_OPTIONS, null, null),
            new ListItem('Тележка Б25.#255', ListItem::TYPE_DIRECT, 'Доп1.#113', 'Тележка Б25'),
        ];

        $tree = (new SimpleTreeBuilder())->build($collection);

        $item1 = new ListItem('Total', ListItem::TYPE_BASE, null, null);
        $item2 = new ListItem('ПВЛ', ListItem::TYPE_BASE, 'Total', null);
        $item3 = new ListItem('Стандарт.#1', ListItem::TYPE_OPTIONS, 'ПВЛ', null);
        $item4 = new ListItem('Тележка Б25.#2', ListItem::TYPE_DIRECT, 'Стандарт.#1', 'Тележка Б25');
        $item5 = new ListItem('Доп1.#113', ListItem::TYPE_OPTIONS, null, null);
        $item6 = new ListItem('Тележка Б25.#255', ListItem::TYPE_DIRECT, 'Доп1.#113', 'Тележка Б25');
        $item3->addChild($item4);
        $item2->addChild($item3);
        $item1->addChild($item2);
        $item5->addChild($item6);
        $expected = [$item1, $item5];

        self::assertEquals($expected, $tree);
    }
}

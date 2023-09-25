<?php

namespace UnitTests\Optimacros;

use Optimacros\App\JsonEncoder;
use Optimacros\App\ListItem;
use PHPUnit\Framework\TestCase;

class JsonEncoderTest extends TestCase
{
    public function testSuccessSerializing(): void
    {
        $expected = <<<JSON
[
  {
    "itemName": "Total",
    "parent": null,
    "children": [
      {
        "itemName": "ПВЛ",
        "parent": "Total",
        "children": [
          {
            "itemName": "Стандарт.#1",
            "parent": "ПВЛ",
            "children": [
              {
                "itemName": "Тележка Б25.#2",
                "parent": "Стандарт.#1",
                "children": []
              }
            ]
          }
        ]
      }
    ]
  },
  {
    "itemName": "Доп1.#113",
    "parent": null,
    "children": [
      {
        "itemName": "Тележка Б25.#255",
        "parent": "Доп1.#113",
        "children": []
      }
    ]
  }
]
JSON;

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
        $collection = [$item1, $item5];

        self::assertEquals($expected, (new JsonEncoder())->encode($collection));
    }
}

<?php

namespace Optimacros\App;

class SimpleTreeBuilder
{
    /**
     * @param array<ListItem> $inputCollection
     * @return array<ListItem>
     */
    public function build(array $inputCollection): array
    {
        $outputCollection = [];

        foreach ($inputCollection as $listItem) {
            if ($listItem->getParentId() === null) {
                $outputCollection[] = $this->buildTreeForNode($listItem, $inputCollection);
            }
        }

        return $outputCollection;
    }

    /**
     * @param ListItem $rootItem
     * @param array<ListItem> $collection
     * @return ListItem
     */
    private function buildTreeForNode(ListItem $rootItem, array &$collection): ListItem
    {
        foreach ($collection as $index => $item) {
            if ($item->getParentId() === $rootItem->getId()) {
                unset($collection[$index]);
                $rootItem->addChild($this->buildTreeForNode($item, $collection));
            }
        }

        return $rootItem;
    }
}

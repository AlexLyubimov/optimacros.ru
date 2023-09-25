<?php

namespace Optimacros\App;

use JsonSerializable;

class ListItem implements JsonSerializable
{
    public const TYPE_BASE = 'Изделия и компоненты';
    public const TYPE_OPTIONS = 'Варианты комплектации';
    public const TYPE_DIRECT = 'Прямые компоненты';

    private array $children = [];

    public function __construct(
        private readonly string  $id,
        private readonly string  $type,
        private readonly ?string $parentId,
        private readonly ?string $relation,
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getParentId(): ?string
    {
        return $this->parentId;
    }

    public function getRelation(): ?string
    {
        return $this->relation;
    }

    public function addChild(self $listItem): void
    {
        $this->children[] = $listItem;
    }

    public function jsonSerialize(): array
    {
        return [
            'itemName' => $this->getId(),
            'parent' => $this->getParentId(),
            'children' => $this->children,
        ];
    }
}

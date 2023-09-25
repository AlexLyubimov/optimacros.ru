<?php

namespace Optimacros\App;

class JsonEncoder
{
    /**
     * @param array<ListItem> $collection
     * @return string
     */
    public function encode(array $collection): string
    {
        $json = json_encode($collection, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        // Заменить 4 пробела на 2
        return preg_replace('/^(  +?)\\1(?=[^ ])/m', '$1', $json);
    }
}

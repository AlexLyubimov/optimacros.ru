<?php

namespace Optimacros\App\Contracts;

interface Readable
{
    public function read(string $path): array;
}

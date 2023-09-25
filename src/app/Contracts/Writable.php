<?php

namespace Optimacros\App\Contracts;

interface Writable
{
    public function write(string $path, string $data): void;
}

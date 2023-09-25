<?php

namespace Optimacros\App\Filesystem;

use Optimacros\App\Contracts\Writable;

class FileWriter implements Writable
{
    public function write(string $path, string $data): void
    {
        fwrite(fopen($path, 'w'), $data);
    }
}

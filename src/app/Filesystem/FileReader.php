<?php

namespace Optimacros\App\Filesystem;

use Optimacros\App\Contracts\Readable;
use Optimacros\App\Exceptions\FileNotFoundException;

class FileReader implements Readable
{
    /**
     * @throws FileNotFoundException
     */
    public function read(string $path): array
    {
        if (!file_exists($path)) {
            throw new FileNotFoundException("File $path not exists");
        }

        $stream = fopen($path, 'r');
        $data = [];
        fgetcsv($stream, null, ';'); // skip first line

        while (!feof($stream)) {
            $item = fgetcsv($stream, null, ';');
            if (is_bool($item) || $item[0] == null) {
                break;
            }
            $data[] = $item;
        }
        fclose($stream);

        return $data;
    }
}

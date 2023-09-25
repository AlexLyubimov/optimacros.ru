<?php

namespace UnitTests\Optimacros;

use Optimacros\App\Filesystem\FileWriter;
use PHPUnit\Framework\TestCase;

class FileWriterTest extends TestCase
{
    private const PATH = __DIR__ . '/../_data/tests_result.json';

    public function testSuccess(): void
    {
        @unlink(self::PATH);

        (new FileWriter())->write(self::PATH, 'foo');

        self::assertFileExists(self::PATH);
    }
}

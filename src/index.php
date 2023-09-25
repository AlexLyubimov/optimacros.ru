<?php

use Optimacros\App\Console\BuildTreeCommand;
use Optimacros\App\Filesystem\FileReader;
use Optimacros\App\Filesystem\FileWriter;
use Optimacros\App\JsonEncoder;
use Optimacros\App\SimpleTreeBuilder;

require_once 'vendor/autoload.php';

(new BuildTreeCommand(
    readable: new FileReader(),
    writable: new FileWriter(),
    encoder: new JsonEncoder(),
    builder: new SimpleTreeBuilder(),
))->handle($argv[1], $argv[2]);

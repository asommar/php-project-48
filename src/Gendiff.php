<?php

namespace Gendiff\Gendiff;

use Docopt;

function launchGenDiff(): void
{
    $doc = <<<'DOCOPT'
    Generate diff

    Usage:
        gendiff (-h|--help)
        gendiff (-v|--version)
        gendiff [--format <fmt>] <firstFile> <secondFile>

    Options:
        -h --help                     Show this screen
        -v --version                  Show version
        --format <fmt>                Report format [default: stylish]
    DOCOPT;

    $params = ['version' => 'gendiff 0.0.1'];

    Docopt::handle($doc, $params);
}

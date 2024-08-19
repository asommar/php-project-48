<?php

function getHelp(): string
{
    $doc = <<<'DOCOPT'
    Generate diff

    Usage:
    gendiff (-h|--help)
    gendiff (-v|--version)

    Options:
    -h --help                     Show this screen
    -v --version                  Show version
    DOCOPT;

    return $doc;
}

function showHelp(): void
{
    echo getHelp();
    echo PHP_EOL;
}

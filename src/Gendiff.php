<?php

namespace Gendiff\Gendiff;

use Docopt;
use function Gendiff\CompareArrays\compareArrays;

function getJSONData(string $filePath): array
{
    $file = file_get_contents($filePath);
    return json_decode($file, true);
}

function genDiff (string $filePath1, string $filePath2): string
{
    $data1 = getJSONData($filePath1);
    $data2 = getJSONData($filePath2);

    $resultArray = compareArrays($data1, $data2); //todo result format

    return json_encode($resultArray);
}

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

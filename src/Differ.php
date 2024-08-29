<?php

namespace Differ\Differ;

use Docopt;

use function Differ\CompareArrays\compareArrays;

function getJSONData(string $filePath): array
{
    $file = file_get_contents($filePath);
    return json_decode($file, true);
}

function formatResult(array $diff): string
{
    $lines = array_map(function ($item) {
        $mark = match ($item['mark']) {
            -1 => '-',
            1 => '+',
            default => ' ',
        };
        $value = match ($item['value']) {
            true => 'true',
            false => 'false',
            default => $item['value'],
        };
        return " {$mark} {$item['key']}: {$value}";
    }, $diff);
    $result = implode("\n", $lines);
        return "{\n{$result}\n}";
}

function genDiff(string $filePath1, string $filePath2): string
{
    $data1 = getJSONData($filePath1);
    $data2 = getJSONData($filePath2);

    $resultArray = compareArrays($data1, $data2);

    return formatResult($resultArray);
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

    $command = Docopt::handle($doc, $params);
    //todo if need check the answer
    $result = genDiff($command['<firstFile>'], $command['<secondFile>']) . PHP_EOL;
    print_r($result);
}

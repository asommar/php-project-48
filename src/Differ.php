<?php

namespace Differ\Differ;

use function Differ\CompareArrays\compareArrays;
use function Differ\Parsers\getFileData;

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
    $data1 = getFileData($filePath1);
    $data2 = getFileData($filePath2);

    $resultArray = compareArrays($data1, $data2);

    return formatResult($resultArray);
}

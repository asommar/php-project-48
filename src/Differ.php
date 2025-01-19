<?php

namespace Differ\Differ;

use function Differ\CompareArrays\compareTrees;
use function Differ\Formatter\formatResult;
use function Differ\Parsers\getFileData;

function genDiff(string $filePath1, string $filePath2, string $format): string
{
    $data1 = getFileData($filePath1);
    $data2 = getFileData($filePath2);

    $resultArray = compareTrees($data1, $data2);

    return formatResult($resultArray, $format);
}

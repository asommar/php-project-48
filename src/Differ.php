<?php

namespace Differ\Differ;

use Exception;
use function Differ\CompareArrays\compareTrees;
use function Differ\Formatter\formatResult;
use function Differ\Parsers\getFileData;

function genDiff(string $filePath1, string $filePath2, string $format): string
{
    try {
        $data1 = getFileData($filePath1);
        $data2 = getFileData($filePath2);
    } catch (Exception $e) {
        echo $e->getMessage();
        die();
    }

    $resultArray = compareTrees($data1, $data2);

    try {
        return formatResult($resultArray, $format);
    } catch (Exception $e) {
        echo $e->getMessage();
        die();
    }
}

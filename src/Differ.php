<?php

namespace Differ\Differ;

const DEFAULT_FORMAT = 'stylish';

use Exception;
use function Differ\CompareArrays\compareTrees;
use function Differ\Formatter\formatResult;
use function Differ\Parsers\getData;

/**
 * @throws Exception
 */
function genDiff(string $filePath1, string $filePath2, string $format = DEFAULT_FORMAT): string
{
    $data1 = getData($filePath1);
    $data2 = getData($filePath2);

    $resultArray = compareTrees($data1, $data2);

    return formatResult($resultArray, $format);
}

<?php

namespace Differ\Parsers;

use Exception;
use Symfony\Component\Yaml\Yaml;

/**
 * @throws Exception
 */
function getFileData(string $filePath): array
{
    if (file_exists($filePath) === false) {
        throw new Exception("No such file or directory: '{$filePath}'\n");
    }

    $file = file_get_contents($filePath);
    if (false === $file) {
        throw new Exception("Unable to read file: '{$filePath}'\n");
    }

    if (str_ends_with(strtolower($filePath), '.json')) {
        $result = json_decode($file, true);
    } elseif (str_ends_with(strtolower($filePath), '.yaml') || str_ends_with(strtolower($filePath), '.yml')) {
        $result = Yaml::parseFile($filePath);
    } else {
        throw new Exception("File '{$filePath}' has unsupported extension\n");
    }

    return $result;
}

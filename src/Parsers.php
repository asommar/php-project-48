<?php

namespace Differ\Parsers;

use Symfony\Component\Yaml\Yaml;

function getFileData(string $filePath): array
{
    $file = file_get_contents($filePath);
    if (false === $file) {
        throw new \Exception("No such file or directory: '{$filePath}'");
    }

    if (str_ends_with(strtolower($filePath),'.json')) {
        $result = json_decode($file, true);
    } elseif(str_ends_with(strtolower($filePath),'.yaml') || str_ends_with(strtolower($filePath),'.yml')) {
        $result = Yaml::parseFile($filePath);
    } else {
        throw new \Exception("File '{$filePath}' has unsupported extension");
    }

    return $result;
}

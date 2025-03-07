<?php

namespace Differ\Parsers;

use Exception;
use Symfony\Component\Yaml\Yaml;

/**
 * @throws Exception
 */
function getData(string $filePath): array
{
    return parseFileData($filePath, getFileData($filePath));
}

/**
 * @throws Exception
 */
function getFileData(string $filePath): string
{
    if (file_exists($filePath) === false) {
        throw new Exception("No such file or directory: '{$filePath}'\n");
    }

    $file = file_get_contents($filePath);
    if (false === $file) {
        throw new Exception("Unable to read file: '{$filePath}'\n");
    }

    return $file;
}

/**
 * @throws Exception
 */
function parseFileData(string $filePath, string $file): array
{
    $extension = pathinfo($filePath, PATHINFO_EXTENSION);
    return match ($extension) {
        'json' => parseJson($file, $filePath),
        'yaml', 'yml' => parseYaml($file, $filePath),
        default => throw new Exception(message: "File '{$filePath}' has unsupported extension\n"),
    };
}

/**
 * @throws Exception
 */
function parseYaml(string $file, string $filePath): array
{
    try {
        return Yaml::parse($file);
    } catch (Exception $e) {
        throw new Exception(message: "Failed to parse YAML file '{$filePath}': {$e->getMessage()}\n");
    }
}

/**
 * @throws Exception
 */
function parseJson(string $file, string $filePath): array
{
    try {
        return json_decode(json: $file, associative: true, flags: JSON_THROW_ON_ERROR);
    } catch (Exception $e) {
        throw new Exception(message: "Failed to parse JSON file '{$filePath}': {$e->getMessage()}");
    }
}

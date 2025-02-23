<?php

namespace Differ\Formatter;

use Differ\Formatters\Stylish;
use Differ\Formatters\Plain;
use Exception;

/**
 * @throws Exception
 */
function formatResult(array $diff, string $format): string
{
    return match ($format) {
        'stylish' => Stylish\formatResult($diff),
        'plain' => Plain\formatResult($diff),
        default => throw new Exception("Unsupportable format: '{$format}'")
    };
}

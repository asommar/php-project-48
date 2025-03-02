<?php

namespace Differ\Formatters\Plain;

function formatValue(mixed $value): string
{
    if (is_array($value)) {
        return "[complex value]";
    }
    return match ($value) {
        true => "true",
        false => "false",
        null => "null",
        default => is_int($value) ? "$value" : "'{$value}'",
    };
}

function makeLine(string $property, int $mark, string $value = null, string $newValue = null): string
{
    if ($newValue !== null) {
        return "Property '{$property}' was updated. From {$value} to {$newValue}";
    } elseif ($mark === -1) {
        return "Property '{$property}' was removed";
    } elseif ($mark === 1) {
        return "Property '{$property}' was added with value: {$value}";
    } else {
        return "Can't identify state of property '{$property}'";
    }
}

function formatResult(array $diff, array $acc = [], string $path = ''): string
{
    $result = array_reduce($diff, function (array $acc, array $item) use ($path) {
        $pathCurrent = $path === '' ? $item['key'] : "{$path}.{$item['key']}";
        $value = $item['value'];

        if (is_array($value) && array_is_list($value)) {
            return [...$acc, formatResult($value, [], $pathCurrent)];
        }

        if ($item['mark'] === 0 || $item['isUpdatedValue'] === false) {
            return $acc;
        }

        $valueFormated = formatValue($value);
        $newValue = $item['isUpdatedValue'] === true ? formatValue($item['newValue']) : null;
        $line = makeLine($pathCurrent, $item['mark'], $valueFormated, $newValue);

        return [...$acc, $line];
    }, $acc);

    return implode(PHP_EOL, $result);
}

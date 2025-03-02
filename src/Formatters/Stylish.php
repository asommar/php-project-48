<?php

namespace Differ\Formatters\Stylish;

const INDENT_SYMBOL = ' ';
const INDENT_COUNT = 4;
const PROPERTY_DELETED = '-';
const PROPERTY_ADDED = '+';
const PROPERTY_NOT_CHANGED = ' ';

function formatValue(mixed $value): string
{
    return match ($value) {
        true => 'true',
        false => 'false',
        null => 'null',
        default => $value,
    };
}

function getIndent(int $depth, int $offset): string
{
    $count = INDENT_COUNT * $depth - $offset;

    return str_repeat(INDENT_SYMBOL, $count);
}

function formatResult(array $diff, int $depth = 1): string
{
    $lines = array_map(function ($item) use ($depth) {
        $indent = getIndent($depth, INDENT_COUNT / 2);
        $mark = match ($item['mark'] ?? null) {
            -1 => PROPERTY_DELETED,
            1 => PROPERTY_ADDED,
            default => PROPERTY_NOT_CHANGED,
        };

        if (key_exists('value', $item) && key_exists('key', $item)) {
            $value = $item['value'];
            $key = $item['key'];
        } else {
            $value = $item;
            $key = '';
        }
        if (is_array($value)) {
            if (!array_is_list($value)) {
                $arrayValue = array_map(fn ($item) => ['value' => $value[$item], 'key' => $item], array_keys($value));
            } else {
                $arrayValue = $value;
            }
            $valuePrepared = formatResult($arrayValue, $depth + 1);
        } else {
            $valuePrepared = formatValue($value);
        }
        return "{$indent}{$mark} {$key}: {$valuePrepared}";
    }, $diff);
    $indentBrace = getIndent($depth - 1, 0);
    $result = implode("\n", $lines);
    return "{\n{$result}\n{$indentBrace}}";
}

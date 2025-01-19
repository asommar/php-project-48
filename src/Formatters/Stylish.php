<?php

namespace Differ\Formatters\Stylish;

define('INDENT_SYMBOL', ' ');
define('INDENT_COUNT', 4);

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
        $indent = getIndent($depth, 2);
        $mark = match ($item['mark'] ?? null) {
            -1 => '-',
            1 => '+',
            default => ' ',
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
                $valuePrepared = [];
                foreach ($value as $keyAssoc => $valueAssoc) {
                    $valuePrepared[] = ['value' => $valueAssoc, 'key' => $keyAssoc];
                }
                $value = $valuePrepared;
            }
            $value = formatResult($value, $depth + 1);
        } else {
            $value = formatValue($value);
        }
        return "{$indent}{$mark} {$key}: {$value}";
    }, $diff);
    $indentBrace = getIndent($depth - 1, 0);
    $result = implode("\n", $lines);
    return "{\n{$result}\n{$indentBrace}}";
}

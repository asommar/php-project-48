<?php

namespace Gendiff\CompareArrays;

function putDiffMark(array $array, int $mark): array
{
    return array_map(
        fn ($key, $value) => ['key' => $key, 'value' => $value, 'mark' => $mark],
        array_keys($array),
        array_values($array)
    );
}

function compareArrays(array $array1, array $array2): array
{
    $common = putdiffMark(array_intersect_assoc($array1, $array2), 0);
    $diff1 = putdiffMark(array_diff_assoc($array1, $array2), -1);
    $diff2 = putdiffMark(array_diff_assoc($array2, $array1), 1);
    $result = array_merge_recursive($common, $diff1, $diff2);
    usort($result, function ($a, $b) {
        return ($a['key'] <=> $b['key']) ?: ($a['mark'] <=> $b['mark']);
    });

    return $result;
}

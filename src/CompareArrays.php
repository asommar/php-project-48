<?php

namespace Differ\CompareArrays;

function putDiffMark(mixed $key, mixed $value, int $mark, bool $isUpdatedValue = null, mixed $newValue = null): array
{
    return ['key' => $key, 'value' => $value, 'mark' => $mark,
        'newValue' => $newValue, 'isUpdatedValue' => $isUpdatedValue];
}

function compareTrees(array $array1, array $array2): array
{
    $keys = array_unique(array_merge(array_keys($array1), array_keys($array2)));
    $keysSorted = \Functional\sort($keys, fn ($first, $second) => $first <=> $second);

    return array_reduce($keysSorted, function ($carry, $key) use ($array1, $array2) {
        $keyExist1 = key_exists($key, $array1);
        $keyExist2 = key_exists($key, $array2);
        //key1 exist, key2 not
        if ($keyExist1 && !$keyExist2) {
            return [...$carry, putDiffMark($key, $array1[$key], -1)];
        }
        //key2 exit, key1 not
        if (!$keyExist1 && $keyExist2) {
            return [...$carry, putDiffMark($key, $array2[$key], 1)];
        }
        //both exist
        $value1 = $array1[$key];
        $value2 = $array2[$key];
        //if assoc in both - go deeper
        if (is_array($value1) && !array_is_list($value1) && is_array($value2) && !array_is_list($value2)) {
            return [...$carry, putDiffMark($key, compareTrees($value1, $value2), 0)];
        }
        //if list - compare values, but maybe need to put mark to children
        //if scalar - compare values
        if ($value1 === $value2) {
            return [...$carry, putDiffMark($key, $value1, 0)];
        }
        //not equal
        //first with -1
        //second with 1
        $deleted = putDiffMark($key, $value1, -1, true, $value2);
        $added = putDiffMark($key, $value2, 1, false);
        return [...$carry, $deleted, $added];
    }, []);
}

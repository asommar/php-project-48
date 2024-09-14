<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

use function Differ\CompareArrays\compareTrees;

class CompareArraysTest extends TestCase
{
    public function testCompareArrays(): void
    {
        $arr1 = [
            "host" => "hexlet.io",
            "timeout" => 50,
            "proxy" => "123.234.53.22",
            "follow" => false
        ];
        $arr2 = [
            "timeout" => 20,
            "verbose" => true,
            "host" => "hexlet.io"
        ];
        $expected = [
            ['key' => 'follow', 'value' => false, 'mark' => -1],
            ['key' => 'host', 'value' => 'hexlet.io', 'mark' => 0],
            ['key' => 'proxy', 'value' => '123.234.53.22', 'mark' => -1],
            ['key' => 'timeout', 'value' => 50, 'mark' => -1],
            ['key' => 'timeout', 'value' => 20, 'mark' => 1],
            ['key' => 'verbose', 'value' => true, 'mark' => 1]
        ];
        $this->assertEquals($expected, compareTrees($arr1, $arr2));
    }

    public function testCompareArraysNested(): void
    {
        $arr1 = [
            "common" => [
                "setting1" => "Value 1",
                "setting2" => 200,
                "setting3" => true,
            ]
        ];
        $arr2 = [
            "common" => [
                "setting1" => "Value 1",
                "follow" => false,
                "setting3" => null,
            ]
        ];
        $expected = [
            ['key' => 'common', 'value' => [
                ['key' => 'follow', 'value' => false, 'mark' => 1],
                ['key' => 'setting1', 'value' => "Value 1", 'mark' => 0],
                ['key' => 'setting2', 'value' => 200, 'mark' => -1],
                ['key' => 'setting3', 'value' => true, 'mark' => -1],
                ['key' => 'setting3', 'value' => null, 'mark' => 1]
            ], 'mark' => 0]
        ];
        $actual =  compareTrees($arr1, $arr2);
        $this->assertEquals($expected, $actual);
    }
}

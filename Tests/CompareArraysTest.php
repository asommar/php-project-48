<?php

namespace Differ\Tests;

use PHPUnit\Framework\TestCase;
use function Differ\CompareArrays\compareArrays;

class CompareArraysTest extends TestCase
{
    public function testCompareArrays():void
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
        $this->assertEquals($expected, compareArrays($arr1, $arr2));
    }
}
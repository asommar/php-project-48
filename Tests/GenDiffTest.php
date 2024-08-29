<?php

namespace Gendiff\Tests;

use PHPUnit\Framework\TestCase;
use function Differ\CompareArrays\compareArrays;
use function Differ\Differ\genDiff;

class GendiffTest extends TestCase
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
    public function testGendiff(): void
    {
        $diff = "{\n - follow: false\n   host: hexlet.io\n - proxy: 123.234.53.22\n - timeout: 50\n + timeout: 20\n + verbose: true\n}";
        $actual = genDiff("Tests/TestFiles/file1.json", "Tests/TestFiles/file2.json");
        $this->assertEquals($diff, $actual);
    }
}
<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

use function Differ\CompareArrays\compareTrees;
use function Differ\Differ\genDiff;

class DifferTest extends TestCase
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
            ['key' => 'follow', 'value' => false, 'mark' => -1, 'newValue' => null, 'isUpdatedValue' => null],
            ['key' => 'host', 'value' => 'hexlet.io', 'mark' => 0, 'newValue' => null, 'isUpdatedValue' => null],
            ['key' => 'proxy', 'value' => '123.234.53.22', 'mark' => -1, 'newValue' => null, 'isUpdatedValue' => null],
            ['key' => 'timeout', 'value' => 50, 'mark' => -1, 'newValue' => 20, 'isUpdatedValue' => true],
            ['key' => 'timeout', 'value' => 20, 'mark' => 1, 'newValue' => null, 'isUpdatedValue' => false],
            ['key' => 'verbose', 'value' => true, 'mark' => 1, 'newValue' => null, 'isUpdatedValue' => null]
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
                ['key' => 'follow', 'value' => false, 'mark' => 1, 'newValue' => null, 'isUpdatedValue' => null],
                ['key' => 'setting1', 'value' => "Value 1", 'mark' => 0, 'newValue' => null, 'isUpdatedValue' => null],
                ['key' => 'setting2', 'value' => 200, 'mark' => -1, 'newValue' => null, 'isUpdatedValue' => null],
                ['key' => 'setting3', 'value' => true, 'mark' => -1, 'isUpdatedValue' => true, 'newValue' => null],
                ['key' => 'setting3', 'value' => null, 'mark' => 1, 'newValue' => null, 'isUpdatedValue' => false],
            ], 'mark' => 0, 'newValue' => null, 'isUpdatedValue' => null]
        ];
        $actual =  compareTrees($arr1, $arr2);
        $this->assertEquals($expected, $actual);
    }

    private function testGenDiff(string $format): void
    {
        $diff = file_get_contents($this->getFixtureFullPath("$format.txt"));
        $jsonPath1 = $this->getFixtureFullPath("file1.json");
        $jsonPath2 = $this->getFixtureFullPath("file2.json");
        $actual1 = genDiff($jsonPath1, $jsonPath2, $format);
        $this->assertEquals($diff, $actual1);

        $yamlPath1 = $this->getFixtureFullPath("file1.yaml");
        $yamlPath2 = $this->getFixtureFullPath("file2.yaml");
        $actual2 = genDiff($yamlPath1, $yamlPath2, $format);
        $this->assertEquals($diff, $actual2);

        $actual3 = genDiff($jsonPath1, $yamlPath2, $format);
        $this->assertEquals($diff, $actual3);

        $actual4 = genDiff($yamlPath1, $jsonPath2, $format);
        $this->assertEquals($diff, $actual4);
    }

    private function getFixtureFullPath(string $fixtureName): string
    {
        $parts = [__DIR__, 'fixtures', $fixtureName];
        return realpath(implode('/', $parts));
    }

    public function testStylish(): void
    {
        $this->testGenDiff('stylish');
    }

    public function testPlain(): void
    {
        $this->testGenDiff('plain');
    }

    public function testJson(): void
    {
        $this->testGenDiff('json');
    }
}

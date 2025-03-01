<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DifferTest extends TestCase
{
//    private function testGenDiff(string $format): void
//    {
//        $diff = file_get_contents($this->getFixtureFullPath("$format.txt"));
//        $jsonPath1 = $this->getFixtureFullPath("file1.json");
//        $jsonPath2 = $this->getFixtureFullPath("file2.json");
//        $actual1 = genDiff($jsonPath1, $jsonPath2, $format);
//        $this->assertEquals($diff, $actual1);
//
//        $yamlPath1 = $this->getFixtureFullPath("file1.yaml");
//        $yamlPath2 = $this->getFixtureFullPath("file2.yaml");
//        $actual2 = genDiff($yamlPath1, $yamlPath2, $format);
//        $this->assertEquals($diff, $actual2);
//
//        $actual3 = genDiff($jsonPath1, $yamlPath2, $format);
//        $this->assertEquals($diff, $actual3);
//
//        $actual4 = genDiff($yamlPath1, $jsonPath2, $format);
//        $this->assertEquals($diff, $actual4);
//    }

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

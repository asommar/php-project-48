<?php

namespace Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DifferTest extends TestCase
{
    private function getFixtureFullPath(string $fixtureName): string
    {
        $parts = [__DIR__, 'fixtures', $fixtureName];
        return realpath(implode('/', $parts));
    }

    private function testGenDiff(string $format): void
    {
        $diff = file_get_contents($this->getFixtureFullPath("$format.txt"));
        $jsonPath1 = $this->getFixtureFullPath("file1.json");
        $jsonPath2 = $this->getFixtureFullPath("file2.json");
        $yamlPath1 = $this->getFixtureFullPath("file1.yaml");
        $yamlPath2 = $this->getFixtureFullPath("file2.yaml");

        $actual1 = genDiff($jsonPath1, $jsonPath2, $format);
        $this->assertEquals($diff, $actual1);

        $actual2 = genDiff($yamlPath1, $yamlPath2, $format);
        $this->assertEquals($diff, $actual2);

        $actual3 = genDiff($jsonPath1, $yamlPath2, $format);
        $this->assertEquals($diff, $actual3);

        $actual4 = genDiff($yamlPath1, $jsonPath2, $format);
        $this->assertEquals($diff, $actual4);
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

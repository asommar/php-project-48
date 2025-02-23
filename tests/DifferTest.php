<?php

namespace Tests;

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
        $diff = file_get_contents($this->getFixtureFullPath("{$format}.txt"));

        $actual1 = genDiff(
            $this->getFixtureFullPath("nested1.json"),
            $this->getFixtureFullPath("nested2.json"),
            $format
        );
        $this->assertEquals($diff, $actual1);

        $actual2 = genDiff(
            $this->getFixtureFullPath("nested1.yaml"),
            $this->getFixtureFullPath("nested2.yaml"),
            $format
        );
        $this->assertEquals($diff, $actual2);

        $actual3 = genDiff(
            $this->getFixtureFullPath("nested1.json"),
            $this->getFixtureFullPath("nested2.yaml"),
            $format
        );
        $this->assertEquals($diff, $actual3);
    }

    public function testStylish(): void
    {
        $this->testGenDiff('stylish');
    }

    public function testPlain(): void
    {
        $this->testGenDiff('plain');
    }
}

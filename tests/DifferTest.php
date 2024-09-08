<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DifferTest extends TestCase
{
    public function getFixtureFullPath(string $fixtureName): string
    {
        $parts = [__DIR__, 'fixtures', $fixtureName];
        return realpath(implode('/', $parts));
    }

    public function testGenDiffFlat(): void
    {
        $diff = file_get_contents($this->getFixtureFullPath("flatDiff.txt"));
        $actual1 = genDiff($this->getFixtureFullPath("flat1.json"), $this->getFixtureFullPath("flat2.json"));
        $this->assertEquals($diff, $actual1);
        $actual2 = genDiff($this->getFixtureFullPath("flat1.yml"), $this->getFixtureFullPath("flat2.yaml"));
        $this->assertEquals($diff, $actual2);
        $actual3 = genDiff($this->getFixtureFullPath("flat1.yml"), $this->getFixtureFullPath("flat2.json"));
        $this->assertEquals($diff, $actual3);
    }
    public function testGenDiffNested(): void
    {
        $diff = file_get_contents($this->getFixtureFullPath("nestedDiff.txt"));
        $actual1 = genDiff($this->getFixtureFullPath("nested1.json"), $this->getFixtureFullPath("nested2.json"));
        $this->assertEquals($diff, $actual1);
        $actual2 = genDiff($this->getFixtureFullPath("nested1.yaml"), $this->getFixtureFullPath("nested2.yaml"));
        $this->assertEquals($diff, $actual2);
        $actual3 = genDiff($this->getFixtureFullPath("nested1.json"), $this->getFixtureFullPath("nested2.yaml"));
        $this->assertEquals($diff, $actual3);
    }
}

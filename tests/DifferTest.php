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

    public function testGenDiff(): void
    {
        $diff = file_get_contents($this->getFixtureFullPath("stylish.txt"));
        $actual1 = genDiff($this->getFixtureFullPath("nested1.json"), $this->getFixtureFullPath("nested2.json"));
        $this->assertEquals($diff, $actual1);
        $actual2 = genDiff($this->getFixtureFullPath("nested1.yaml"), $this->getFixtureFullPath("nested2.yaml"));
        $this->assertEquals($diff, $actual2);
        $actual3 = genDiff($this->getFixtureFullPath("nested1.json"), $this->getFixtureFullPath("nested2.yaml"));
        $this->assertEquals($diff, $actual3);
    }
}

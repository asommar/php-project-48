<?php

namespace Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DifferTest extends TestCase
{
    public function getFixtureFullPath($fixtureName): string
    {
        $parts = [__DIR__, 'fixtures', $fixtureName];
        return realpath(implode('/', $parts));
    }

    public function testGenDiff(): void
    {
        $diff = implode("\n", [
            "{",
            " - follow: false",
            "   host: hexlet.io",
            " - proxy: 123.234.53.22",
            " - timeout: 50",
            " + timeout: 20",
            " + verbose: true",
            "}"
        ]);
        $actual1 = genDiff($this->getFixtureFullPath("flat1.json"), $this->getFixtureFullPath("flat2.json"));
        $this->assertEquals($diff, $actual1);
        $actual2 = genDiff($this->getFixtureFullPath("flat1.yml"), $this->getFixtureFullPath("flat2.yaml"));
        $this->assertEquals($diff, $actual2);
    }
}

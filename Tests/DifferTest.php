<?php

namespace Differ\Tests;


use PHPUnit\Framework\TestCase;
use function Differ\Differ\genDiff;

class DifferTest extends TestCase
{
    public function testGenDiff(): void
    {
        $diff = "{\n - follow: false\n   host: hexlet.io\n - proxy: 123.234.53.22\n - timeout: 50\n + timeout: 20\n + verbose: true\n}";
        $actual1 = genDiff("Tests/TestFiles/file1.json", "Tests/TestFiles/file2.json");
        $this->assertEquals($diff, $actual1);
        $actual2 = genDiff("Tests/TestFiles/file1.yml", "Tests/TestFiles/file2.yaml");
        $this->assertEquals($diff, $actual2);
    }
}
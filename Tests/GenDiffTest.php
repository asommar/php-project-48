<?php

namespace Gendiff\Tests;

use PHPUnit\Framework\TestCase;
use function Gendiff\Gendiff\genDiff;

class GendiffTest extends TestCase
{
    public function testGendiff(): void
    {
        $diff = "{
                  - follow: false
                    host: hexlet.io
                  - proxy: 123.234.53.22
                  - timeout: 50
                  + timeout: 20
                  + verbose: true
                }";
        $actual = genDiff("TestFiles//file1.json", "TestFiles//file2.json");
        $this->assertEquals($diff, $actual);
    }
}
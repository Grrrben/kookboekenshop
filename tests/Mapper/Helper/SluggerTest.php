<?php

namespace App\Tests\Mapper\Helper;

use App\Mapper\Helper\Slugger;
use PHPUnit\Framework\TestCase;

class SluggerTest extends TestCase
{
    /**
     * @dataProvider slugDataProvider
     */
    public function testTransform(string $raw, string $expected)
    {
        $slugger = new Slugger();
        $actual = $slugger->transform($raw);

        $this->assertEquals($expected, $actual);
    }

    public function slugDataProvider(): array
    {
        return [
            ['Dit is een string 1 234', 'dit-is-een-string-1-234'],
            ['á, é, í, ó, ú', 'a-e-i-o-u'],
            ['Title met @ en & er in', 'title-met-at-en-en-er-in'],
        ];
    }
}

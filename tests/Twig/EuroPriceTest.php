<?php

namespace App\Tests\Twig;

use App\Twig\EuroPrice;
use PHPUnit\Framework\TestCase;

class EuroPriceTest extends TestCase
{
    /**
     * @dataProvider dpEuroPrices
     */
    public function testFormatPrice(int $number, string $expected)
    {
        $extension = new EuroPrice();
        $actual = $extension->formatPrice($number);

        $this->assertEquals($expected, $actual);
    }

    public function dpEuroPrices(): array
    {
        return [
            [1, "€ 0,01"],
            [0, "€ 0,00"],
            [100, "€ 1,00"],
            [100000, "€ 1.000,00"],
            [1234567, "€ 12.345,67"],
            [12345678910, "€ 123.456.789,10"],
        ];
    }
}

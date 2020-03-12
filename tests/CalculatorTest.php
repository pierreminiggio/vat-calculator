<?php

namespace PierreMiniggio\VatCalculatorTest;

use PHPUnit\Framework\TestCase;
use PierreMiniggio\VatCalculator\Calculator;

class CalculatorTest extends TestCase
{
    private Calculator $calculator;

    public function setUp()
    {
        $this->calculator = new Calculator();
    }

    public function provideTests(): array
    {
        return [
            ['tax_free_amount' => 100., 'vat' => 0., 'tax_included_amount' => 100.],
            ['tax_free_amount' => 100., 'vat' => .2, 'tax_included_amount' => 120.],
            ['tax_free_amount' => 100., 'vat' => .1, 'tax_included_amount' => 110.],
            ['tax_free_amount' => 100., 'vat' => .085, 'tax_included_amount' => 108.5],
            ['tax_free_amount' => 50., 'vat' => .2, 'tax_included_amount' => 60.]
        ];
    }

    public function provideTaxIncludedToTaxFreeRoundTests(): array
    {
        return [
            ['tax_included_amount' => 367.36, 'vat' => .2, 'tax_free_amount' => 306.13]
        ];
    }

    public function testToTaxIncluded()
    {
        foreach ($this->provideTests() as $test) {
            $this->assertSame($test['tax_included_amount'], $this->calculator->toTaxIncluded($test['tax_free_amount'], $test['vat']));
        }
    }

    public function testToTaxFree()
    {
        foreach ($this->provideTests() as $test) {
            $this->assertSame($test['tax_free_amount'], $this->calculator->toTaxFree($test['tax_included_amount'], $test['vat']));
        }
    }

    public function testToTaxFreeRounded()
    {
        foreach ($this->provideTaxIncludedToTaxFreeRoundTests() as $test) {
            $this->assertSame($test['tax_free_amount'], $this->calculator->toTaxFree($test['tax_included_amount'], $test['vat']));
        }
    }
}

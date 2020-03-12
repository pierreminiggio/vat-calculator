<?php

namespace PierreMiniggio\VatCalculator;

class Calculator
{

    /**
     * @param float $taxFreeAmount
     * @param float $vatRate       as a decimal value (example: 20% -> 0.2)
     *
     * @return float
     */
    public function toTaxIncluded($taxFreeAmount, $vatRate)
    {
        return (float) number_format($taxFreeAmount * (1 + $vatRate), 2, '.', '');
    }

    /**
     * @param float $taxIncludedAmount
     * @param float $vatRate           as a decimal value (example: 20% -> 0.2)
     *
     * @return float
     */
    public function toTaxFree($taxIncludedAmount, $vatRate)
    {
        return (float) number_format($taxIncludedAmount / (1 + $vatRate), 2, '.', '');
    }
}

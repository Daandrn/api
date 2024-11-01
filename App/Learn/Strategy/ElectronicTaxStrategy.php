<?php declare(strict_types=1);

namespace App\Learn\Strategy;

require __DIR__.'/../../../vendor/autoload.php';

class ElectronicTaxStrategy implements TaxStrategy
{
    public function calculateTax(float $amount): float
    {
        // Imposto de 15% para produtos eletrônicos
        return $amount * 0.15;
    }
}

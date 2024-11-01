<?php declare(strict_types=1);

namespace App\Learn\Strategy;

require __DIR__.'/../../../vendor/autoload.php';

interface TaxStrategy
{
    public function calculateTax(float $amount): float;
}

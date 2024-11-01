<?php declare(strict_types=1);

namespace App\Learn\DecoratorWithStrategy;

require __DIR__.'/../../../vendor/autoload.php';

interface PaymentStrategy
{
    public function pay(float $amount): bool;
}
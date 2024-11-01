<?php declare(strict_types=1);

namespace App\Learn\DecoratorWithStrategy;

require __DIR__.'/../../../vendor/autoload.php';

abstract class PaymentDecorator implements PaymentStrategy
{
    protected PaymentStrategy $payment;

    public function __construct(PaymentStrategy $payment)
    {
        $this->payment = $payment;
    }
    
    public function pay(float $amount): bool
    {
        return $this->payment->pay($amount);
    }
}

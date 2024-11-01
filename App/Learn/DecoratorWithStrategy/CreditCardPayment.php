<?php declare(strict_types=1);

namespace App\Learn\DecoratorWithStrategy;

require __DIR__.'/../../../vendor/autoload.php';

class CreditCardPayment implements PaymentStrategy
{
    public function pay(float $amount): bool
    {
        // Implementação de pagamento com cartão de crédito
        return true;
    }
}

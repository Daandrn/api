<?php declare(strict_types=1);

namespace App\Learn\DecoratorWithStrategy;

require __DIR__.'/../../../vendor/autoload.php';

class BoletoPayment implements PaymentStrategy
{
    public function pay(float $amount): bool
    {
        // Implementação de pagamento com boleto
        return true;
    }
}

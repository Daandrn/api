<?php declare(strict_types=1);

namespace App\Learn\DecoratorWithStrategy;

require __DIR__.'/../../../vendor/autoload.php';

class LogDecorator extends PaymentDecorator
{
    public function pay(float $amount): bool
    {
        echo "Registrando log do pagamento de: {$amount}\n";
        return parent::pay($amount);
    }
}

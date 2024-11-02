<?php declare(strict_types=1);

namespace App\Learn\DecoratorWithStrategy;

require __DIR__.'/../../../vendor/autoload.php';

class LogDecorator extends PaymentDecorator
{
    public function pay(float $amount): bool
    {
        error_log("Registrando log do pagamento de: {$amount}\n");
        error_get_last();
        
        return parent::pay($amount);
    }
}

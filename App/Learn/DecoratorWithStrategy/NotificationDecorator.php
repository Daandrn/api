<?php declare(strict_types=1);

namespace App\Learn\DecoratorWithStrategy;

require __DIR__.'/../../../vendor/autoload.php';

class NotificationDecorator extends PaymentDecorator
{
    public function pay(float $amount): bool
    {
        error_log("Enviando notificação de pagamento...\n");
        error_get_last();
        
        return parent::pay($amount);
    }
}

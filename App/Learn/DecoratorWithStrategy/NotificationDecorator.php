<?php declare(strict_types=1);

namespace App\Learn\DecoratorWithStrategy;

require __DIR__.'/../../../vendor/autoload.php';

class NotificationDecorator extends PaymentDecorator
{
    public function pay(float $amount): bool
    {
        echo "Enviando notificação de pagamento...\n";
        return parent::pay($amount);
    }
}

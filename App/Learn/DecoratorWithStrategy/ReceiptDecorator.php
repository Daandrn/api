<?php declare(strict_types=1);

namespace App\Learn\DecoratorWithStrategy;

require __DIR__.'/../../../vendor/autoload.php';

class ReceiptDecorator extends PaymentDecorator
{
    public function pay(float $amount): bool
    {
        echo "Gerando recibo de pagamento...\n";
        return parent::pay($amount);
    }
}

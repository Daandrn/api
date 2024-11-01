<?php declare(strict_types=1);

namespace App\Learn\Observer;

require __DIR__.'/../../../vendor/autoload.php';

class Logger implements ObserverInterface
{
    public function update(Order $order): void
    {
        echo "Log: Pedido atualizado para '{$order->getStatus()}'\n";
    }
}

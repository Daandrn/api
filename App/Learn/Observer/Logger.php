<?php declare(strict_types=1);

namespace App\Learn\Observer;

require __DIR__.'/../../../vendor/autoload.php';

class Logger implements ObserverInterface
{
    public function update(Order $order): void
    {
        error_log("Log: Pedido atualizado para '{$order->getStatus()}'\n");
        error_get_last();
    }
}

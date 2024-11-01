<?php declare(strict_types=1);

namespace App\Learn\Observer;

require __DIR__.'/../../../vendor/autoload.php';

interface ObserverInterface
{
    public function update(Order $order): void;
}

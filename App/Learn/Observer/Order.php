<?php declare(strict_types=1);

namespace App\Learn\Observer;

require __DIR__.'/../../../vendor/autoload.php';

class Order
{
    private array $observers = [];
    private string $status;

    public function attach(ObserverInterface $observer): void
    {
        $this->observers[] = $observer;
    }

    public function detach(ObserverInterface $observer): void
    {
        $this->observers = array_filter(
            $this->observers,
            fn($o) => $o !== $observer
        );
    }

    public function notify(): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function updateStatus(string $status): void
    {
        $this->status = $status;
        $this->notify();
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}

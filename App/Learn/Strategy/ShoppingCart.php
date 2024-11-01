<?php declare(strict_types=1);

namespace App\Learn\Strategy;

require __DIR__.'/../../../vendor/autoload.php';

class ShoppingCart
{
    private array $items = [];
    private TaxStrategy $taxStrategy;

    public function __construct(TaxStrategy $taxStrategy)
    {
        $this->taxStrategy = $taxStrategy;
    }

    public function addItem(string $name, float $price): void
    {
        $this->items[$name] = $price;
    }

    public function calculateTotal(): float
    {
        $total = array_sum($this->items);
        $tax = $this->taxStrategy->calculateTax($total);
        return $total + $tax;
    }

    public function setTaxStrategy(TaxStrategy $taxStrategy): void
    {
        $this->taxStrategy = $taxStrategy;
    }
}

<?php declare(strict_types=1);

namespace App\Strategy;

require __DIR__.'/../../vendor/autoload.php';

interface StrategyInterface
{
    public function validate(object $param): string|null;
}

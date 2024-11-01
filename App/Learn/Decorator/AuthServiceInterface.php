<?php declare(strict_types=1);

namespace App\Learn\Decorator;

require __DIR__.'/../../../vendor/autoload.php';

interface AuthServiceInterface
{
    public function authenticate(array $credentials): bool;
}
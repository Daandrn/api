<?php declare(strict_types=1);

namespace App\Learn\Decorator;

require __DIR__.'/../../../vendor/autoload.php';

abstract class AuthDecorator implements AuthServiceInterface
{
    protected AuthServiceInterface $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }
}

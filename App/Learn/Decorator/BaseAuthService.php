<?php declare(strict_types=1);

namespace App\Learn\Decorator;

require __DIR__.'/../../../vendor/autoload.php';

class BaseAuthService implements AuthServiceInterface
{
    public function authenticate(array $credentials): bool
    {
        // Verificação básica de login e senha
        return $credentials['username'] === 'user' && $credentials['password'] === 'secret';
    }
}
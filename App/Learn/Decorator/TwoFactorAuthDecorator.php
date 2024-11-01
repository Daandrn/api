<?php declare(strict_types=1);

namespace App\Learn\Decorator;

require __DIR__.'/../../../vendor/autoload.php';

class TwoFactorAuthDecorator extends AuthDecorator
{
    public function authenticate(array $credentials): bool
    {
        // Primeiro, verifica a autenticação básica
        if (!$this->authService->authenticate($credentials)) {
            return false;
        }
        
        // Verificação de código de dois fatores (simulado)
        return $credentials['2fa_code'] === '123456';
    }
}

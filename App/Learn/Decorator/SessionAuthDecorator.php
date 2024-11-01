<?php declare(strict_types=1);

namespace App\Learn\Decorator;

require __DIR__.'/../../../vendor/autoload.php';

class SessionAuthDecorator extends AuthDecorator
{
    public function authenticate(array $credentials): bool
    {
        // Primeiro, verifica a autenticação básica e o código 2FA
        if (!$this->authService->authenticate($credentials)) {
            return false;
        }
        
        // Simula a verificação de sessão
        return isset($credentials['session_id']) && $credentials['session_id'] === 'session_123';
    }
}

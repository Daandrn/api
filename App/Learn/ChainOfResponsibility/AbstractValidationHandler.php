<?php declare(strict_types=1);

namespace App\Learn\ChainOfResponsibility;

require __DIR__.'/../../../vendor/autoload.php';

abstract class AbstractValidationHandler implements ValidationHandler
{
    private ?ValidationHandler $nextHandler = null;

    public function setNext(ValidationHandler $handler): ValidationHandler
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    public function handle(object $data): ?string
    {
        if ($this->nextHandler) {
            return $this->nextHandler->handle($data);
        }
        return null;
    }
}

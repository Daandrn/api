<?php declare(strict_types=1);

namespace App\Learn\ChainOfResponsibility;

require __DIR__.'/../../../vendor/autoload.php';

interface ValidationHandler
{
    public function setNext(ValidationHandler $handler): ValidationHandler;
    public function handle(object $data): ?string;
}

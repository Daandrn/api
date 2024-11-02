<?php declare(strict_types=1);

namespace App\Learn\ChainOfResponsibility;

require __DIR__.'/../../../vendor/autoload.php';

class XRangeValidation extends AbstractValidationHandler
{
    public function handle(object $data): ?string
    {
        if ($data->x < 1 || $data->x > 10) {
            return "O valor de X deve estar entre 1 e 10.";
        }
        return parent::handle($data);
    }
}

<?php declare(strict_types=1);

namespace App\Learn\ChainOfResponsibility;

require __DIR__.'/../../../vendor/autoload.php';

class YOptionsValidation extends AbstractValidationHandler
{
    public function handle(object $data): ?string
    {
        $validYValues = match($data->x) {
            2 => [10, 20],
            5 => [15, 18],
            default => []
        };

        if (!in_array($data->y, $validYValues)) {
            return "Erro: O valor de Y é inválido para o valor de X = {$data->x}.";
        }
        return parent::handle($data);
    }
}

<?php declare(strict_types=1);

namespace App\Strategy;

use Vendor\requests\Api;

require __DIR__.'/../../vendor/autoload.php';

class HiringDateGreaterThanBirthDate implements StrategyInterface
{
    public function validate(object $param): string|null
    {
        if ($param->birth_date > $param->hire_date) {
            return 'Data de nascimento maior que data de contratação!';
        }

        return null;
    }
}

<?php declare(strict_types=1);

namespace App\Strategy;

use Vendor\requests\Api;

class NameEmpty implements StrategyInterface
{
    public function validate(object $param): string|null
    {
        if (empty($param->first_name) && empty($param->last_name)) {
            return 'Nome não pode ser vazio!';
        }

        return null;
    }
}
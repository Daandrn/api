<?php declare(strict_types=1);

namespace App\Strategy;

use App\DTO\DTOinterface;
use Vendor\requests\Api;

class StrategyValidation
{
    protected array $errors = [];
    protected array $validations = [];
    
    public function __construct(
        protected DTOinterface $dto,
    ) {
        //
    }
    
    public function add(StrategyInterface $strategy): void
    {
        $this->validations[] = $strategy;
    }

    public function validate(): void
    {
        foreach ($this->validations as $item) {
            $response = $item->validate($this->dto);
            
            if ($response) {
                $this->errors[] = $response;
            }
        }
    }

    public function getErrors(): array|null
    {
        return empty($this->errors) 
            ? null
            : $this->errors;
    }
}

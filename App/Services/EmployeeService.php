<?php declare(strict_types=1);

namespace App\Services;

use App\DTO\EmployeeCreateDTO;
use App\Repositories\Employee;
use App\Strategy\HiringDateGreaterThanBirthDate;
use App\Strategy\NameEmpty;
use App\Strategy\StrategyValidation;
use Vendor\requests\Api;

require __DIR__.'/../../vendor/autoload.php';

class EmployeeService
{
    public function __construct(
        protected Employee $repository
    ) {
        //
    }

    public function insert(EmployeeCreateDTO $dto): object
    {
        $validation = new StrategyValidation($dto);
        $validation->add(new HiringDateGreaterThanBirthDate);
        $validation->add(new NameEmpty);
        $validation->validate();
        $errors = $validation->getErrors();

        return (object) [
            'error'   => !empty($errors),
            'errors'  => $errors,
            'message' => null,
        ];
    }
}

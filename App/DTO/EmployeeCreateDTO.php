<?php declare(strict_types=1);

namespace App\DTO;

use DateTime;

require __DIR__.'/../../vendor/autoload.php';

class EmployeeCreateDTO implements DTOinterface
{
    public function __construct(
        public int    $emp_no,
        public DateTime $birth_date,
        public string $first_name,
        public string $last_name,
        public string $gender,
        public DateTime $hire_date
    ) {
        //
    }

    public static function make(object $params): self
    {
        return new self(
            $params->emp_no,
            $params->birth_date,
            $params->first_name,
            $params->last_name,
            $params->gender,
            $params->hire_date
        );
    }

    public function toArray(): array
    {
        return [
            'emp_no'     => $this->emp_no,
            'birth_date' => $this->birth_date,
            'first_name' => $this->first_name,
            'last_name'  => $this->last_name,
            'gender'     => $this->gender,
            'hire_date'  => $this->hire_date
        ];
    }
}

<?php declare(strict_types=1);

namespace App\Controllers;

use App\DTO\EmployeeCreateDTO;
use App\Repositories\Employee;
use App\Services\EmployeeService;
use Vendor\requests\Api;

require __DIR__ . '/../../vendor/autoload.php';

class EmployeeController
{
    protected EmployeeService $service;
    
    public function __construct()
    {
        $this->service = new EmployeeService(new Employee);
    }
    
    public function insert(): void
    {
        $employee = (object) [
            'emp_no' => 500_000,
            'birth_date' => date_create('now'),
            'first_name' => '',
            'last_name' => '',
            'gender' => 'M',
            'hire_date' => date_create_from_format('d/m/Y', '01/05/2020'),
        ];
        
        $reponse = $this->service->insert(
            EmployeeCreateDTO::make($employee)
        );
        
        Api::response([
            'errors'  => $reponse->errors,
            'message' => $reponse->message
        ], 200, $reponse->error);
    }
}
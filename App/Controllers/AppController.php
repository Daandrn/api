<?php

namespace App\Controllers;

use App\Repositories\Employee;
use App\Repositories\Salary;
use DateTime;
use Vendor\requests\Api;
use Vendor\requests\Request;

require __DIR__ . '/../../vendor/autoload.php';

class AppController
{
    protected array $body = [];
    protected Salary $salary;
    
    public function __construct()
    {
        $this->salary = new Salary();
    }

    public function inicio()
    {
        Api::response([
            'Voce está na app controller mas nao fez nada aqui'
        ]);
    }
}

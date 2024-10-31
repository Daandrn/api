<?php 

namespace Routes;

use App\Controllers\AppController;
use App\Controllers\EmployeeController;

require __DIR__ . '/../vendor/autoload.php';

class Web
{
    public static function routes(): array {
        return [
            'POST' => [
                'funcionario/criar' => [EmployeeController::class, 'insert']
            ],
            'GET' => [
                'inicio' => [AppController::class, 'inicio']
            ]
        ];
    }
}
 
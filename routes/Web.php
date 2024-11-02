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
                'funcionario/criar' => [EmployeeController::class, 'insert'],
                'learn/observer' => [AppController::class, 'observer'],
                'learn/strategy' => [AppController::class, 'strategy'],
                'learn/decorator' => [AppController::class, 'decorator'],
                'learn/decoratorwithstrategy' => [AppController::class, 'decoratorwithstrategy'],
                'learn/chainofresponsability' => [AppController::class, 'chainofresponsability'],
                'learn/reflection' => [AppController::class, 'reflection'],
            ],
            'GET' => [
                '' => [AppController::class, 'main'],
            ]
        ];
    }
}
 
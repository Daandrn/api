<?php

namespace Vendor\router;

use App\Controllers\AppController;
use Exception;
use Vendor\requests\Api;
use Routes\Web;

require __DIR__ . '/../autoload.php';

class Router
{
    protected static array $routes;
    protected static string $clientRoute;
    
    public function __construct()
    {
        self::$routes = Web::routes();
        
        self::$clientRoute = ltrim($_SERVER['PATH_INFO'], '/');
    }

    public function routes(): void
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                if (isset(self::$routes['POST'][strval(self::$clientRoute)])) {
                    $route = self::$routes['POST'][self::$clientRoute];

                    (new $route[0])->{$route[1]}();

                    return;
                }

                Api::response([
                    'error' => "Acesso não autorizado!"
                ], 404, true);

                break;
            case 'GET':
                if (isset(self::$routes['GET'][strval(self::$clientRoute)])) {
                    $route = self::$routes['GET'][self::$clientRoute];

                    (new $route[0])->{$route[1]}();

                    return;
                }
                
                Api::response([
                    'error' => "Acesso não autorizado!"
                ], 404, true);

                break;
            default:
                throw new Exception('Metódo inválido!', 500);
        }
    }
}

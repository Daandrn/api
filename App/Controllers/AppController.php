<?php

namespace App\Controllers;

use App\Learn\ChainOfResponsibility\{XRangeValidation, YOptionsValidation};
use App\Learn\Decorator\{BaseAuthService, SessionAuthDecorator, TwoFactorAuthDecorator};
use App\Learn\DecoratorWithStrategy\{CreditCardPayment, LogDecorator, NotificationDecorator, ReceiptDecorator};
use App\Learn\Observer\{EmailNotifier, Order, Logger};
use App\Learn\Reflection\User;
use App\Learn\Strategy\{ElectronicTaxStrategy, FoodTaxStrategy, ShoppingCart};
use ReflectionClass;
use Vendor\requests\Api;
use Vendor\requests\Request;

require __DIR__ . '/../../vendor/autoload.php';

class AppController
{
    public function __construct()
    {
        //
    }

    public function main()
    {
        Api::response([
            'Voce está na app controller mas nao fez nada aqui'
        ]);
    }

    public function reflection()
    {
        // Cria uma instância da classe ReflectionClass
        $reflection = new ReflectionClass(User::class);

        $classInfo['class_name'] = $reflection->getName();

        // Obtém os métodos da classe
        $methods = $reflection->getMethods();

        foreach ($methods as $method) {
            $classMethods[] = $method->getName();
        }
        
        $classInfo['class_methods'] = $classMethods;

        // Obtém as propriedades da classe
        $properties = $reflection->getProperties();
        
        foreach ($properties as $property) {
            $classProperties[] = [
                'property_name' => $property->getName(),
                'access' => $property->isPublic() ? 'Público' : 'Privado'
            ];
        }

        $classInfo['class_properties'] = $classProperties;
        
        // Verifica se a classe tem um construtor
        if ($reflection->hasMethod('__construct')) {
            $hasConstruct = 'A classe tem um construtor';
        }

        $classInfo['class_has_construct'] = $hasConstruct;
        
        Api::response([
            $classInfo
        ]);
    }

    public function observer(): void
    {
        $order = new Order();
        $order->attach(new EmailNotifier());
        $order->attach(new Logger());

        $order->updateStatus("Enviado");

        Api::response([
            'order_status' => $order->getStatus()
        ]);
    }

    public function strategy(): void
    {
        $cart = new ShoppingCart(new ElectronicTaxStrategy());
        $cart->addItem("Smartphone", 600);
        $cart->addItem("Laptop", 1200);

        $valueTotalEletronics = $cart->valueTotal();

        $cart->setTaxStrategy(new FoodTaxStrategy());
        $cart->addItem("Apple", 2);
        $cart->addItem("Bread", 3);

        $valueTotalFoods = $cart->valueTotal();

        Api::response([
            'Total_com_imposto_eletrônico' => $valueTotalEletronics,
            'Total_com_imposto_alimentos' => $valueTotalFoods
        ]);
    }

    public function decorator(): void
    {
        $credentials = [
            'username' => 'user',
            'password' => 'secret',
            '2fa_code' => '123456',
            'session_id' => 'session_123'
        ];
        
        $authService = new BaseAuthService();
        $authService = new TwoFactorAuthDecorator($authService);
        $authService = new SessionAuthDecorator($authService);
        
        $response = $authService->authenticate($credentials) 
            ? "Autenticação bem-sucedida!"
            : "Autenticação falhou!";
        
        Api::response([
            'response' => $response
        ]);
    }

    public function decoratorwithstrategy(): void
    {
        $payment = new CreditCardPayment();
        $payment = new LogDecorator($payment);
        $payment = new NotificationDecorator($payment);
        $payment = new ReceiptDecorator($payment);
        
        $response = $payment->pay(100.00)
            ? 'Pagamento realizado!'
            : 'Pagamento não realizado!';
        
        Api::response([
            'response' => $response
        ]);
    }

    public function chainOfResponsability(): void
    {
        $data = (object) ['x' => 2, 'y' => 25];

        $xValidation = new XRangeValidation();
        $yValidation = new YOptionsValidation();

        $xValidation->setNext($yValidation);

        $result = $xValidation->handle($data);

        Api::response([
            'response' => $result ?? "Validações concluídas com sucesso!"
        ]);
    }
}

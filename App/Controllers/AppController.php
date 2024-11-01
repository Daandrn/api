<?php

namespace App\Controllers;

use App\Learn\ChainOfResponsibility\{XRangeValidation, YOptionsValidation};
use App\Learn\Decorator\{BaseAuthService, SessionAuthDecorator, TwoFactorAuthDecorator};
use App\Learn\DecoratorWithStrategy\{CreditCardPayment, LogDecorator, NotificationDecorator, ReceiptDecorator};
use App\Learn\Observer\{EmailNotifier, Order, Logger};
use App\Learn\Strategy\{ElectronicTaxStrategy, FoodTaxStrategy, ShoppingCart};
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

    public function observer(): void
    {
        $order = new Order();
        $order->attach(new EmailNotifier());
        $order->attach(new Logger());

        $order->updateStatus("Enviado");

        Api::response([
            //
        ]);
    }

    public function strategy(): void
    {
        $cart = new ShoppingCart(new ElectronicTaxStrategy());
        $cart->addItem("Smartphone", 600);
        $cart->addItem("Laptop", 1200);

        echo "Total com imposto eletrônico: " . $cart->calculateTotal() . "\n";

        $cart->setTaxStrategy(new FoodTaxStrategy());
        $cart->addItem("Apple", 2);
        $cart->addItem("Bread", 3);

        echo "Total com imposto de alimentos: " . $cart->calculateTotal() . "\n";

        Api::response([
            //
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
        
        if ($authService->authenticate($credentials)) {
            echo "Autenticação bem-sucedida!";
        } else {
            echo "Autenticação falhou!";
        }
        
        Api::response([
            //
        ]);
    }

    public function decoratorwithstrategy(): void
    {
        $payment = new CreditCardPayment();
        $payment = new LogDecorator($payment);
        $payment = new NotificationDecorator($payment);
        $payment = new ReceiptDecorator($payment);
        
        $payment->pay(100.00);
        
        Api::response([
            //
        ]);
    }

    public function chainOfResponsability(): void
    {
        $data = (object) ['x' => 2, 'y' => 25];

        $xValidation = new XRangeValidation();
        $yValidation = new YOptionsValidation();

        $xValidation->setNext($yValidation);

        $result = $xValidation->handle($data);

        if ($result) {
            echo $result;
        } else {
            echo "Validações concluídas com sucesso!";
        }
    }
}

<?php declare(strict_types=1);

namespace App\Learn\Reflection;

require __DIR__.'/../../../vendor/autoload.php';

class User
{
    public string $name;
    private int $age;

    public function __construct(string $name, int $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function getAge(): int
    {
        return $this->age;
    }
}

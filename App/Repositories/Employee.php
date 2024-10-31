<?php 

namespace App\Repositories;

use Vendor\model\Model;

require __DIR__ . '/../../vendor/autoload.php';

class Employee extends Model
{
    public string $table_name = 'employees';
    public array $fields = [
        //
    ];
    
    public function __construct()
    {
        //
    }
    
    public function __destruct()
    {
        $this->conn = null;
    }
}

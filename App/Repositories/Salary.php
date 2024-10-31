<?php 

namespace App\Repositories;

use Vendor\model\Model;

require __DIR__ . '/../../vendor/autoload.php';

class Salary extends Model
{
    public string $table_name = 'salaries';
    public array $fields = [
        'emp_no',
        'salary',
        'from_date',
        'to_date',
    ];

    public function get(array $employees_emp_no, int $quantity): array
    {
        $emp_nos = implode(', ', $employees_emp_no);
        
        return $this->select(where: ['emp_no', 'in', "({$emp_nos})", "LIMIT $quantity"]);
    }
}

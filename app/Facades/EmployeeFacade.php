<?php


namespace App\Facades;

use App\Models\Employee;
use Illuminate\Support\Facades\Facade;

/**
 * Class EmployeeFacade
 * @package App\Facades
 *
 * @method static Employee create(array $data)
 * @method static Employee update(array $data, Employee $employee)
 */

class EmployeeFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'employee_facade_provider';
    }
}

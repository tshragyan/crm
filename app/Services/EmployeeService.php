<?php


namespace App\Services;


use App\Models\Employee;

class EmployeeService
{
    public function create(array $data) :Employee
    {
        $employee = new Employee();
        $employee->fill($data);
        $employee->save();
        return $employee;
    }

    public function update(array $data, Employee $employee): Employee
    {
        $employee->update($data);
        return $employee;
    }
}

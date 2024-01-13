<?php


namespace App\Repositories;

use App\Models\Employee;
use App\Http\Requests\EmployeeRequest;

interface EmployeeRepositoryInterface
{
    public function query();

    public function store(EmployeeRequest $request);

    public function update(Employee $employee, EmployeeRequest $request);

    public function destroy(Employee $employee);
}
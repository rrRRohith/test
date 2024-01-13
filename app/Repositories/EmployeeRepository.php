<?php


namespace App\Repositories;

use App\Models\Employee;
use App\Http\Requests\EmployeeRequest;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    /**
     * Display a listing of the resource.
     */
    public function query(){
        return Employee::query();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request){
        return Employee::create($request->only(['first_name', 'last_name', 'email', 'phone', 'company_id']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Employee $employee, EmployeeRequest $request){
        return $employee->update($request->only(['first_name', 'last_name', 'email', 'phone', 'company_id']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee){
        return $employee->delete();
    }
}
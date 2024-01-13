<?php

namespace App\Http\Controllers;

use App\Models\{Employee, Company};
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use Yajra\DataTables\DataTables;
use App\Repositories\{
    EmployeeRepositoryInterface, CompanyRepositoryInterface
};

class EmployeeController extends Controller
{
    protected $employees;
    protected $companies;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(EmployeeRepositoryInterface $employees, CompanyRepositoryInterface $companies)
    {
        $this->middleware('auth');
        $this->employees = $employees;
        $this->companies = $companies;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $request->ajax() ? DataTables::of($this->employees->query())->addColumn('actions', function ($employee) {
            return view('employees.partials.actions')->withEmployee($employee);
        })->addColumn('company_name', function ($employee) {
            return $employee->company->name ?? null;
        })->addColumn('full_name', function ($employee) {
            return $employee->name;
        })->filterColumn('full_name', function ($q, $k) {
            $q->whereRaw("CONCAT(first_name, ' ', last_name) like ?", ["%{$k}%"]);
        })->filterColumn('company_name', function ($q, $k) {
            $q->whereHas('company', fn($q) => $q->where('name', 'like', "%{$k}%"));
        })->rawColumns(['actions'])->make(true) : view('employees.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return  view('employees.form')->withCompanies($this->companies->query()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        \DB::beginTransaction();
        try{
            $this->employees->store($request);
            \DB::commit();
            return redirect()->route('employees.index')->withSuccess(__("Employee created successfully."));
        }
        catch(\Exception $e){
            \DB::rollBack();
			return $this->error($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return view('employees.form')->withEmployee($employee)->withCompanies($this->companies->query()->get());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        \DB::beginTransaction();
        try{
            $this->employees->update($employee, $request);
            \DB::commit();
            return redirect()->route('employees.index')->withSuccess(__("Employee updated successfully."));
        }
        catch(\Exception $e){
            \DB::rollBack();
			return $this->error($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        \DB::beginTransaction();
        try{
            $this->employees->destroy($employee);
            \DB::commit();
            return redirect()->route('employees.index')->withSuccess(__("Employee deleted successfully."));
        }
        catch(\Exception $e){
            \DB::rollBack();
			return $this->error($e);
        }
    }
}

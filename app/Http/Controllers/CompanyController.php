<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use Yajra\DataTables\DataTables;
use App\Repositories\CompanyRepositoryInterface;

class CompanyController extends Controller
{
    public $companies;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CompanyRepositoryInterface $companies)
    {
        $this->middleware('auth');
        $this->companies = $companies;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $request->ajax() ? DataTables::of($this->companies->query())->addColumn('actions', function ($company) {
            return view('companies.partials.actions')->withCompany($company);
        })->rawColumns(['actions'])->make(true) : view('companies.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {
        \DB::beginTransaction();
        try{
            $this->companies->store($request);
            \DB::commit();
            return redirect()->route('companies.index')->withSuccess(__("Company created successfully."));
        }
        catch(\Exception $e){
            \DB::rollBack();
			return $this->error($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('companies.form')->withCompany($company);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, Company $company)
    {
        \DB::beginTransaction();
        try{
            $this->companies->update($company, $request);
            \DB::commit();
            return redirect()->route('companies.index')->withSuccess(__("Company updated successfully."));
        }
        catch(\Exception $e){
            \DB::rollBack();
			return $this->error($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        \DB::beginTransaction();
        try{
            $this->companies->destroy($company);
            \DB::commit();
            return redirect()->route('companies.index')->withSuccess(__("Company deleted successfully."));
        }
        catch(\Exception $e){
            \DB::rollBack();
			return $this->error($e);
        }
    }
}

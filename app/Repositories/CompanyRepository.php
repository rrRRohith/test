<?php


namespace App\Repositories;

use App\Models\Company;
use App\Http\Requests\CompanyRequest;

class CompanyRepository implements CompanyRepositoryInterface
{
    use \App\Services\Uploader;
    /**
     * Display a listing of the resource.
     */
    public function query(){
        return Company::query();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request){
        $company = Company::create($request->only(['name', 'email', 'website']));
        if($logo = $this->upload('logo', $request)){
            $company->update(['logo' => $logo]);
        }
        return $company;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Company $company, CompanyRequest $request){
        $company->update($request->only(['name', 'email', 'website']));
        if($logo = $this->upload('logo', $request)){
            $company->update(['logo' => $logo]);
        }
        return $company;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company){
        return $company->delete();
    }
}
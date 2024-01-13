<?php


namespace App\Repositories;

use App\Models\Company;
use App\Http\Requests\CompanyRequest;

interface CompanyRepositoryInterface
{
    public function query();

    public function store(CompanyRequest $request);

    public function update(Company $company, CompanyRequest $request);

    public function destroy(Company $company);
}
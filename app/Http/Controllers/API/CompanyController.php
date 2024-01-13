<?php

namespace App\Http\Controllers\API;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Resources\CompanyResource;
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
        $this->middleware('auth:sanctum');
        $this->companies = $companies;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $companies = $this->companies->query()->paginate(10);

        return response()->json([
            'total' => $companies->total(),
            'data' => CompanyResource::collection($companies),
            'next_page' => $companies->nextPageUrl(),
            'prev_page' => $companies->previousPageUrl(),
        ]);
    }
}

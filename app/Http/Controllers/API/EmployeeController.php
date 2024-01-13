<?php

namespace App\Http\Controllers\API;

use App\Models\{Employee, Company};
use Illuminate\Http\Request;
use App\Http\Resources\EmployeeResource;
use App\Repositories\EmployeeRepositoryInterface;

class EmployeeController extends Controller
{
    protected $employees;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(EmployeeRepositoryInterface $employees)
    {
        $this->middleware('auth:sanctum');
        $this->employees = $employees;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $employees = $this->employees->query()->with('company')->paginate(10);

        return response()->json([
            'total' => $employees->total(),
            'data' => EmployeeResource::collection($employees),
            'next_page' => $employees->nextPageUrl(),
            'prev_page' => $employees->previousPageUrl(),
        ]);
    }
}

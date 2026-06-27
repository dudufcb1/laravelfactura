<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index()
    {
        return response()->json(Company::orderBy('name')->get());
    }

    public function show(Company $company)
    {
        return response()->json($company);
    }
}

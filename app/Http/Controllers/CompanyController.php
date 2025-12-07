<?php

namespace App\Http\Controllers;

use App\Models\Company;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::withCount(['users', 'shortUrls'])->get();

        return view('companies.index', compact('companies'));
    }
}

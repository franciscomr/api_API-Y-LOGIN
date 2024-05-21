<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Company\CompanyCollection;
use App\Models\Api\Company\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    public function index()
    {
        $rescourceCollection = Company::FetchData(request('sort'),request('filter'),request('fields'))->get();
        return CompanyCollection::make($rescourceCollection);
        
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Company $company)
    {
        //
    }

    public function edit(Company $company)
    {
        //
    }

    public function update(Request $request, Company $company)
    {
        //
    }

    public function destroy(Company $company)
    {
        //
    }
}

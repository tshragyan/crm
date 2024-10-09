<?php

namespace App\Http\Controllers;

use App\Facades\CompanyFacade;
use App\Http\Requests\CompanyCreateRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Models\Company;
use Yajra\DataTables\DataTables;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('company.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyCreateRequest $request)
    {
        $company = CompanyFacade::create($request->validated());
        return redirect(route('company.show', ['company' => $company->id]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return view('company.view', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyUpdateRequest $request, Company $company)
    {
        CompanyFacade::update($request->validated(), $company);
        return view('company.view', compact('company'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        CompanyFacade::delete($company);
        return redirect(route('company.index'));
    }

    public function getData()
    {
        $companies = Company::select(['id', 'name', 'email', 'logo', 'created_at']);

        return DataTables::of($companies)
            ->addColumn('logo', function($company) {
                $url = asset('storage/' . $company->logo);
                return '<img src="' . $url . '" alt="Logo" height="70" width="70">';
            })
            ->addColumn('action', function ($company) {
                return '
                <a href="' . route('company.show', ['company' => $company->id]) . '" class="btn btn-sm btn-primary">View</a>
                <a href="' . route('company.edit', ['company' => $company->id]) . '" class="btn btn-sm btn-warning">Edit</a>
                <form action="'. route('company.destroy', ['company' => $company->id]). '" method="post">
                    <input type="hidden" name="_token" value="'. csrf_token() .'" autocomplete="off">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
                ' ;
            })
            ->rawColumns(['logo', 'action'])
            ->make(true);
    }
}

<?php

namespace App\Http\Controllers;

use App\Facades\EmployeeFacade;
use App\Http\Requests\EmployeeCreateRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('employee.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::select(['id', 'name'])->get();
        return view('employee.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeCreateRequest $request)
    {
        $employee = EmployeeFacade::create($request->validated());
        return view('employee.view', compact('employee'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return view('employee.view', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $companies = Company::select(['id', 'name'])->get();
        return view('employee.edit', compact('employee', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeUpdateRequest $request, Employee $employee)
    {
        $employee = EmployeeFacade::update($request->validated(), $employee);
        $companies = Company::select(['id', 'name'])->get();
        return view('employee.view', compact('employee', 'companies'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect(route('employee.index'));
    }

    public function getData()
    {
        $employees = Employee::select(['id', 'name', 'last_name', 'email', 'phone', 'created_at']);

        return DataTables::of($employees)
            ->addColumn('action', function ($employee) {
                return '
                <a href="' . route('employee.show', ['employee' => $employee->id]) . '" class="btn btn-sm btn-primary">View</a>
                <a href="' . route('employee.edit', ['employee' => $employee->id]) . '" class="btn btn-sm btn-warning">Edit</a>
                <form action="'. route('employee.destroy', ['employee' => $employee->id]). '" method="post">
                    <input type="hidden" name="_token" value="'. csrf_token() .'" autocomplete="off">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
                ' ;
            })
            ->make(true);
    }
}

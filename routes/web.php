<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('company/get-data', [CompanyController::class, 'getData'])->name('company.data');
    Route::get('employee/get-data', [EmployeeController::class, 'getData'])->name('employee.data');
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('employee', EmployeeController::class);
    Route::resource('company', CompanyController::class);
});


Auth::routes();



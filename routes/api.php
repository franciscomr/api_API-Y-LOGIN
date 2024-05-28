<?php

use App\Http\Controllers\Api\Company\BranchController;
use App\Http\Controllers\Api\Company\CompanyController;
use App\Http\Controllers\Api\Company\DepartmentController;
use App\Http\Controllers\Api\Company\EmployeeController;
use App\Http\Controllers\Api\Company\PositionController;
use App\Http\Middleware\Api\ValidateJsonApiRequestFormat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(CompanyController::class)->group(function () {
    Route::get('companies', 'index')->name('companies.index');
    Route::get('companies/{id}', 'show')->name('companies.show');
    Route::post('companies', 'store')->middleware(ValidateJsonApiRequestFormat::class)->name('companies.store');
    Route::patch('companies/{id}', 'update')->middleware(ValidateJsonApiRequestFormat::class)->name('companies.update');
});

Route::controller(BranchController::class)->group(function () {
    Route::get('branches', 'index')->name('branches.index');
    Route::get('branches/{id}', 'show')->name('branches.show');
    Route::post('branches', 'store')->middleware(ValidateJsonApiRequestFormat::class)->name('branches.store');
    Route::patch('branches/{id}', 'update')->middleware(ValidateJsonApiRequestFormat::class)->name('branches.update');
});

Route::controller(DepartmentController::class)->group(function () {
    Route::get('departments', 'index')->name('departments.index');
    Route::get('departments/{id}', 'show')->name('departments.show');
    Route::post('departments', 'store')->middleware(ValidateJsonApiRequestFormat::class)->name('departments.store');
    Route::patch('departments/{id}', 'update')->middleware(ValidateJsonApiRequestFormat::class)->name('departments.update');
});

Route::controller(PositionController::class)->group(function () {
    Route::get('positions', 'index')->name('positions.index');
    Route::get('positions/{id}', 'show')->name('positions.show');
    Route::post('positions', 'store')->middleware(ValidateJsonApiRequestFormat::class)->name('positions.store');
    Route::patch('positions/{id}', 'update')->middleware(ValidateJsonApiRequestFormat::class)->name('positions.update');
});

Route::controller(EmployeeController::class)->group(function () {
    Route::get('employees', 'index')->name('employees.index');
    Route::get('employees/{id}', 'show')->name('employees.show');
    Route::post('employees', 'store')->middleware(ValidateJsonApiRequestFormat::class)->name('employees.store');
    Route::patch('employees/{id}', 'update')->middleware(ValidateJsonApiRequestFormat::class)->name('employees.update');
});

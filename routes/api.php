<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ImportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('employee')->group(function () {
    // Import employee
    Route::post('/', [ImportController::class, 'import']);
    // Employee management routes
    Route::get('/', [EmployeeController::class, 'index']);
    Route::get('/{employee}', [EmployeeController::class, 'show']);
    Route::delete('/{employee}', [EmployeeController::class, 'destroy']);
});

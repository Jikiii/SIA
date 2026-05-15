<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\RenterController;
use App\Http\Controllers\LeaseController;
use App\Http\Controllers\InspectionController;

// Dashboard (Home)
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('branches', BranchController::class);
Route::resource('staff', StaffController::class);
Route::resource('properties', PropertyController::class);
Route::resource('renters', RenterController::class);
Route::resource('leases', LeaseController::class);
Route::resource('inspections', InspectionController::class);
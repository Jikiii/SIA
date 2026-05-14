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

// Pages for each section
Route::get('/branches', [BranchController::class, 'index'])->name('branches.index');
Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/renters', [RenterController::class, 'index'])->name('renters.index');
Route::get('/leases', [LeaseController::class, 'index'])->name('leases.index');
Route::get('/inspections', [InspectionController::class, 'index'])->name('inspections.index');
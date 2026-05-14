<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch counts from database
        $counts = [
            'branches' => DB::table('Branch')->count(),
            'staff' => DB::table('Staff')->count(),
            'properties' => DB::table('Property')->where('Status', 'Available')->count(),
            'renters' => DB::table('Renter')->count(),
            'leases' => DB::table('Lease')->where('Status', 'Active')->count(),
            'inspections' => DB::table('Inspection')->count(),
        ];

        // Return the view with the data
        return view('dashboard', compact('counts'));
    }
}
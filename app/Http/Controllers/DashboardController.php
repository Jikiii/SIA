<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Update property statuses automatically
        $properties = Property::with('leases')->get();

        foreach ($properties as $property) {
            // Check if property has any active lease
            $hasActiveLease = $property->leases
                ->where('Status', 'Active')
                ->where('EndDate', '>=', Carbon::today())
                ->count() > 0;

            $newStatus = $hasActiveLease ? 'Rented' : 'Available';

            // Update DB only if it changed
            if ($property->Status !== $newStatus) {
                $property->Status = $newStatus;
                $property->save();
            }
        }

        //  Fetch counts for dashboard
      $counts = [
        'branches' => DB::table('Branch')->count(),
        'staff' => DB::table('Staff')->count(),
        'properties' => DB::table('Property')->count(), 
        'renters' => DB::table('Renter')->count(),
        'leases' => DB::table('Lease')->where('Status','Active')->count(),
        'inspections' => DB::table('Inspection')->count(),
    ];


        return view('dashboard', compact('counts'));
    }
}
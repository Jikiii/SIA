<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lease;
use App\Models\Property;
use App\Models\Renter;
use App\Models\Staff;
use Carbon\Carbon;

class LeaseController extends Controller
{
    /**
     * Display a list of leases
     */
    public function index()
    {
        $leases = Lease::with(['property', 'renter', 'staff'])
                       ->orderBy('StartDate', 'desc')
                       ->get();

        return view('leases.index', compact('leases'));
    }

    /**
     * Show form to create a new lease
     */
    public function create()
    {
        $properties = Property::all();
        $renters    = Renter::all();
        $staff      = Staff::all();

        return view('leases.create', compact('properties', 'renters', 'staff'));
    }

    /**
     * Store a new lease in the database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_id'     => 'required|exists:Property,PropertyID',
            'renter_id'       => 'required|exists:Renter,RenterID',
            'staff_id'        => 'required|exists:Staff,StaffID',
            'rent'            => 'required|numeric|min:0',
            'payment_method'  => 'required|string|max:50',
            'deposit_amount'  => 'nullable|numeric|min:0',
            'is_deposit_paid' => 'nullable|boolean',
            'start_date'      => 'required|date',
            'end_date'        => 'required|date|after:start_date',
        ]);

        $leaseDuration = Carbon::parse($validated['start_date'])
                               ->diffInMonths(Carbon::parse($validated['end_date']));
        $leaseDuration = max(1, $leaseDuration); // minimum 1 month

        Lease::create([
            'PropertyID'    => $validated['property_id'],
            'RenterID'      => $validated['renter_id'],
            'StaffID'       => $validated['staff_id'],
            'Rent'          => $validated['rent'],
            'DepositAmount' => $validated['deposit_amount'] ?? 0,
            'IsDepositPaid' => $validated['is_deposit_paid'] ?? 0,
            'StartDate'     => $validated['start_date'],
            'EndDate'       => $validated['end_date'],
            'LeaseDuration' => $leaseDuration,
            'Status'        => 'Active', // new leases are active
            'PaymentMethod' => $validated['payment_method'],
        ]);

        // Update property status to "Rented"
        $property = Property::findOrFail($validated['property_id']);
        $property->update(['Status' => 'Rented']);

        return redirect()->route('leases.index')
                         ->with('success', 'Lease created successfully!');
    }

    /**
     * Show a single lease
     */
    public function show($id)
    {
        $lease = Lease::with(['property', 'renter', 'staff'])->findOrFail($id);

        return view('leases.show', compact('lease'));
    }

    /**
     * Show form to edit a lease
     */
    public function edit($id)
    {
        $lease      = Lease::findOrFail($id);
        $properties = Property::all();
        $renters    = Renter::all();
        $staff      = Staff::all();

        return view('leases.edit', compact('lease', 'properties', 'renters', 'staff'));
    }

    /**
     * Update an existing lease
     */
    public function update(Request $request, $id)
    {
        $lease = Lease::findOrFail($id);

        // Only validate editable fields
        $validated = $request->validate([
            'property_id'     => 'required|exists:Property,PropertyID',
            'renter_id'       => 'required|exists:Renter,RenterID',
            'staff_id'        => 'required|exists:Staff,StaffID',
            'payment_method'  => 'required|string|max:50',
            'deposit_amount'  => 'nullable|numeric|min:0',
            'is_deposit_paid' => 'nullable|boolean',
            'start_date'      => 'required|date',
            'end_date'        => 'required|date|after:start_date',
        ]);

        // Recalculate LeaseDuration
        $leaseDuration = Carbon::parse($validated['start_date'])
                               ->diffInMonths(Carbon::parse($validated['end_date']));
        $leaseDuration = max(1, $leaseDuration); // minimum 1 month

        // Update the lease
        $lease->update([
            'PropertyID'    => $validated['property_id'],
            'RenterID'      => $validated['renter_id'],
            'StaffID'       => $validated['staff_id'],
            'Rent'          => $lease->Rent, // keep read-only rent
            'DepositAmount' => $validated['deposit_amount'] ?? 0,
            'IsDepositPaid' => $validated['is_deposit_paid'] ?? 0,
            'StartDate'     => $validated['start_date'],
            'EndDate'       => $validated['end_date'],
            'LeaseDuration' => $leaseDuration,
            'Status'        => $lease->Status, // keep existing status
            'PaymentMethod' => $validated['payment_method'],
        ]);

        return redirect()->route('leases.index')
                         ->with('success', 'Lease updated successfully!');
    }

    /**
     * Delete a lease
     */
    public function destroy($id)
    {
        $lease = Lease::findOrFail($id);
        $lease->delete();

        return redirect()->route('leases.index')
                         ->with('success', 'Lease deleted successfully!');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Renter;
use App\Models\Branch;
use App\Models\Staff;

class RenterController extends Controller
{
    // List all renters
    public function index()
    {
        $renters = Renter::with(['branch', 'staff'])
            ->orderBy('RenterID', 'asc')
            ->get();

        return view('renters.index', compact('renters'));
    }

    // Show create form
    public function create()
    {
        $branches = Branch::all();
        $staff = Staff::all();

        return view('renters.create', compact('branches', 'staff'));
    }

    // Store new renter
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name'   => 'required|string|max:50',
            'last_name'    => 'required|string|max:50',
            'address'      => 'required|string|max:200',
            'phone'        => 'required|string|max:20',
            'branch_id'    => 'required|exists:Branch,BranchID',
            'staff_id'     => 'required|exists:Staff,StaffID',
            'date_approved'=> 'required|date',
        ]);

        Renter::create([
            'FirstName'    => $validated['first_name'],
            'LastName'     => $validated['last_name'],
            'Address'      => $validated['address'],
            'Phone'        => $validated['phone'],
            'BranchID'     => $validated['branch_id'],
            'StaffID'      => $validated['staff_id'],
            'DateApproved' => $validated['date_approved'],
        ]);

        return redirect()->route('renters.index')
            ->with('success', 'Renter added successfully!');
    }

  public function show($id)
{
    // Load renter with branch, staff, and leases
    $renter = Renter::with(['branch', 'staff', 'leases.property'])->findOrFail($id);

    return view('renters.show', compact('renter'));
}

   public function edit($id)
    {
        $renter = Renter::findOrFail($id);
        $branches = Branch::all();
        $staff = Staff::all();

        return view('renters.edit', compact('renter', 'branches', 'staff'));
    }

    // Update renter
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'first_name'   => 'required|string|max:50',
            'last_name'    => 'required|string|max:50',
            'address'      => 'required|string|max:200',
            'phone'        => 'required|string|max:20',
            'branch_id'    => 'required|exists:Branch,BranchID',
            'staff_id'     => 'required|exists:Staff,StaffID',
            'date_approved'=> 'required|date',
            'preferred_type' => 'nullable|string|max:50',
            'max_budget'     => 'nullable|numeric',
            'notes'          => 'nullable|string|max:500',
        ]);

        $renter = Renter::findOrFail($id);

        $renter->update([
            'FirstName'     => $validated['first_name'],
            'LastName'      => $validated['last_name'],
            'Address'       => $validated['address'],
            'Phone'         => $validated['phone'],
            'BranchID'      => $validated['branch_id'],
            'StaffID'       => $validated['staff_id'],
            'DateApproved'  => $validated['date_approved'],
            'PreferredType' => $validated['preferred_type'] ?? null,
            'MaxBudget'     => $validated['max_budget'] ?? null,
            'Notes'         => $validated['notes'] ?? null,
        ]);

        return redirect()->route('renters.index')
            ->with('success', 'Renter updated successfully!');
    }


    public function destroy($id)
    {
        Renter::findOrFail($id)->delete();

        return redirect()->route('renters.index')
            ->with('success', 'Renter deleted successfully!');
    }
}
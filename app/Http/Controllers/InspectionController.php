<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inspection;
use App\Models\Property;
use App\Models\Staff;

class InspectionController extends Controller
{
    // List all inspections
    public function index()
    {
        $inspections = Inspection::with(['property','staff'])
            ->orderBy('InspectDate', 'desc')
            ->get();

        return view('inspections.index', compact('inspections'));
    }

    // Show form to create inspection
    public function create()
    {
        $properties = Property::all();
        $staff = Staff::all();
        return view('inspections.create', compact('properties','staff'));
    }

    // Store inspection
    public function store(Request $request)
    {
        Inspection::create([
            'PropertyID'  => $request->property_id,
            'StaffID'     => $request->staff_id,
            'InspectDate' => $request->inspect_date,
            'Notes'       => $request->notes,
        ]);

        return redirect()->route('inspections.index')
            ->with('success', 'Inspection added successfully!');
    }

    // Show inspection details
    public function show($id)
    {
        $inspection = Inspection::with(['property','staff'])->findOrFail($id);
        return view('inspections.show', compact('inspection'));
    }

    // Show edit form
    public function edit($id)
    {
        $inspection = Inspection::findOrFail($id);
        $properties = Property::all();
        $staff = Staff::all();
        return view('inspections.edit', compact('inspection','properties','staff'));
    }

    // Update inspection
    public function update(Request $request, $id)
    {
        $inspection = Inspection::findOrFail($id);
        $inspection->update([
            'PropertyID'  => $request->property_id,
            'StaffID'     => $request->staff_id,
            'InspectDate' => $request->inspect_date,
            'Notes'       => $request->notes,
        ]);

        return redirect()->route('inspections.index')
            ->with('success', 'Inspection updated successfully!');
    }

    // Delete inspection
    public function destroy($id)
    {
        Inspection::findOrFail($id)->delete();
        return redirect()->route('inspections.index')
            ->with('success', 'Inspection deleted successfully!');
    }
}
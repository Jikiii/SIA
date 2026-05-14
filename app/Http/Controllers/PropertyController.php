<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Staff;
use App\Models\Branch;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::with(['staff', 'branch'])
            ->orderBy('PropertyID', 'asc')
            ->get();

        return view('properties', compact('properties'));
    }

    public function create()
    {
        $staff = Staff::all();
        $branches = Branch::all();

        return view('properties.create', compact('staff', 'branches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'StreetName' => 'required',
            'City'       => 'required',
            'Rooms'      => 'required|numeric',
            'RentAmount' => 'required|numeric'
        ]);

        Property::create($request->all());

        return redirect()->route('properties.index')
            ->with('success', 'Property added successfully!');
    }

    public function show($id)
    {
        $property = Property::with(['staff', 'branch'])
            ->findOrFail($id);

        return view('properties.show', compact('property'));
    }

    public function edit($id)
    {
        $property = Property::findOrFail($id);
        $staff = Staff::all();
        $branches = Branch::all();

        return view('properties.edit', compact('property', 'staff', 'branches'));
    }

    public function update(Request $request, $id)
    {
        $property = Property::findOrFail($id);
        $property->update($request->all());

        return redirect()->route('properties.index')
            ->with('success', 'Property updated successfully!');
    }

    /* Soft withdraw (like your old system) */
    public function destroy($id)
    {
        $property = Property::findOrFail($id);

        $property->Status = 'Withdrawn';
        $property->save();

        return redirect()->route('properties.index')
            ->with('success', 'Property withdrawn successfully!');
    }
}
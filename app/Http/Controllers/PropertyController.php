<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Staff;
use App\Models\PropertyType;

class PropertyController extends Controller
{
   
    // DISPLAY ALL PROPERTIES
  
    public function index()
    {
        $properties = Property::with(['staff', 'type'])
            ->orderBy('PropertyID', 'desc')
            ->get();

        return view('properties.index', compact('properties'));
    }

  
    // SHOW CREATE FORM
   
    public function create()
    {
        $staff = Staff::all();
        $types = PropertyType::all();

        return view('properties.create', compact('staff', 'types'));
    }

  
    // STORE PROPERTY
   
    public function store(Request $request)
    {
        $request->validate([
            'StreetName' => 'required',
            'City' => 'required',
            'Rooms' => 'required|numeric',
            'RentAmount' => 'required|numeric',
            'StaffID' => 'required',
            'PropertyTypeID' => 'required'
        ]);

        Property::create([
            'StaffID' => $request->StaffID,
            'PropertyTypeID' => $request->PropertyTypeID,
            'StreetName' => $request->StreetName,
            'District' => $request->District,
            'City' => $request->City,
            'PostalCode' => $request->PostalCode,
            'Rooms' => $request->Rooms,
            'RentAmount' => $request->RentAmount,
            'Status' => 'Available'
        ]);

        return redirect()->route('properties.index')
            ->with('success', 'Property added successfully!');
    }

   
    // SHOW SINGLE PROPERTY

   public function show($id)
{
    $property = Property::with(['staff', 'type', 'owner', 'leases.renter', 'inspections.staff'])
        ->findOrFail($id);

    return view('properties.show', compact('property'));
}
  
    // SHOW EDIT FORM
    public function edit($id)
    {
        $property = Property::findOrFail($id);

        $staff = Staff::all();

        $types = PropertyType::all();

        return view('properties.edit', compact(
            'property',
            'staff',
            'types'
        ));
    }

    
    // UPDATE PROPERTY
    public function update(Request $request, $id)
    {
        $request->validate([
            'StreetName' => 'required',
            'City' => 'required',
            'Rooms' => 'required|numeric',
            'RentAmount' => 'required|numeric',
            'StaffID' => 'required',
            'PropertyTypeID' => 'required'
        ]);

        $property = Property::findOrFail($id);

        $property->update([
            'StaffID' => $request->StaffID,
            'PropertyTypeID' => $request->PropertyTypeID,
            'StreetName' => $request->StreetName,
            'District' => $request->District,
            'City' => $request->City,
            'PostalCode' => $request->PostalCode,
            'Rooms' => $request->Rooms,
            'RentAmount' => $request->RentAmount,
            'Status' => $request->Status
        ]);

        return redirect()->route('properties.index')
            ->with('success', 'Property updated successfully!');
    }

   
    // DELETE PROPERTY
  
public function destroy($id)
{
    // Find the lease
    $lease = Lease::findOrFail($id);

    // Keep the related property
    $property = $lease->property;

    // Delete the lease
    $lease->delete();

    // Update the property status in DB
    if ($property) {
        $hasActiveLease = $property->leases()
            ->where('Status', 'Active')
            ->where('EndDate', '>=', \Carbon\Carbon::today())
            ->exists();

        $property->Status = $hasActiveLease ? 'Rented' : 'Available';
        $property->save(); // save to database
    }

    return redirect()->route('leases.index')->with('success', 'Lease deleted and property status updated.');
}
}
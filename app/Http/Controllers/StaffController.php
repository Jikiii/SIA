<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Branch;

class StaffController extends Controller
{
    public function index()
    {
        $staff = Staff::with('branch')
            ->orderBy('StaffID', 'asc')
            ->get();

        return view('staff.index', compact('staff'));
    }

    public function create()
    {
        $branches = Branch::all();
        return view('staff.create', compact('branches'));
    }

    public function store(Request $request)
    {
        Staff::create([
            'BranchID'    => $request->branch_no,
            'FirstName'   => $request->first_name,
            'LastName'    => $request->last_name,
            'Address'     => $request->address,
            'Phone'       => $request->telephone,
            'Email'       => $request->email,
            'Gender'      => $request->sex,
            'BirthDate'   => $request->date_of_birth,
            'Position'    => $request->job_title,
            'Salary'      => $request->salary,
            'HireDate'    => $request->date_joined,
            'TypingSpeed' => $request->typing_speed ?? null,
        ]);

        return redirect()->route('staff.index')
            ->with('success', 'Staff added successfully!');
    }

    public function show($id)
    {
        $staff = Staff::with('branch')->findOrFail($id);

        return view('staff.show', compact('staff'));
    }

    public function edit($id)
    {
        $staff = Staff::findOrFail($id);
        $branches = Branch::all();

        return view('staff.edit', compact('staff', 'branches'));
    }

    public function update(Request $request, $id)
    {
        $staff = Staff::findOrFail($id);

        // ✅ FIXED UPDATE (NO REQUEST->ALL BUG)
        $staff->update([
            'BranchID'    => $request->branch_no,
            'FirstName'   => $request->first_name,
            'LastName'    => $request->last_name,
            'Address'     => $request->address,
            'Phone'       => $request->telephone,
            'Email'       => $request->email,
            'Gender'      => $request->sex,
            'BirthDate'   => $request->date_of_birth,
            'Position'    => $request->job_title,
            'Salary'      => $request->salary,
            'HireDate'    => $request->date_joined,
            'TypingSpeed' => $request->typing_speed ?? null,
        ]);

        return redirect()->route('staff.index')
            ->with('success', 'Staff updated successfully!');
    }

    public function destroy($id)
    {
        Staff::findOrFail($id)->delete();

        return redirect()->route('staff.index')
            ->with('success', 'Staff deleted successfully!');
    }
}
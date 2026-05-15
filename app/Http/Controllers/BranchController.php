<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    // List all branches
    public function index()
    {
        $branches = Branch::orderBy('BranchID')->get();
        return view('branches.index', compact('branches'));
    }

    // Show single branch details
    public function show($id)
    {
        $branch = Branch::findOrFail($id);
        return view('branches.show', compact('branch'));
    }

    // Show create form
    public function create()
    {
        return view('branches.create');
    }

    // Store new branch
    public function store(Request $request)
    {
        $data = $request->validate([
            'BranchName' => 'required|string|max:255',
            'Street' => 'required|string|max:255',
            'Area' => 'nullable|string|max:255',
            'City' => 'required|string|max:100',
            'PostCode' => 'required|string|max:20',
            'ContactNo' => 'required|string|max:20',
            'Email' => 'nullable|email|max:255',
        ]);

        Branch::create($data);

        return redirect()->route('branches.index')
                         ->with('success', 'Branch added successfully!');
    }

    // Show edit form
    public function edit($id)
    {
        $branch = Branch::findOrFail($id);
        return view('branches.edit', compact('branch'));
    }

    // Update branch
    public function update(Request $request, $id)
    {
        $branch = Branch::findOrFail($id);

        $data = $request->validate([
            'BranchName' => 'required|string|max:255',
            'Street' => 'required|string|max:255',
            'Area' => 'nullable|string|max:255',
            'City' => 'required|string|max:100',
            'PostCode' => 'required|string|max:20',
            'ContactNo' => 'required|string|max:20',
            'Email' => 'nullable|email|max:255',
        ]);

        $branch->update($data);

        return redirect()->route('branches.show', $branch->BranchID)
                         ->with('success', 'Branch updated successfully!');
    }

    // Delete branch
    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();

        return redirect()->route('branches.index')
                         ->with('success', 'Branch deleted successfully!');
    }
}
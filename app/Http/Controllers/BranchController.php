<?php

namespace App\Http\Controllers;

use App\Models\Branch;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::orderBy('BranchID')->get();

        return view('branches', compact('branches'));
    }

    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);

        $branch->delete();

        return redirect()
            ->route('branches.index')
            ->with('success', 'Branch deleted successfully!');
    }
}
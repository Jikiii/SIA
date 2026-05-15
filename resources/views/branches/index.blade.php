<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Branch Offices</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

@include('partials.navbar')

<div class="container">

    {{-- HEADER --}}
    <div class="card shadow-sm branch-card">

        <div class="card-header bg-white d-flex justify-content-between align-items-center branch-header">

            <h3 class="mb-0 fw-semibold">Branch Offices</h3>

            <a href="{{ url('branches/create') }}" class="btn btn-primary px-4 branch-btn">
                + Add New Branch
            </a>

        </div>

        {{-- TABLE --}}
        <div class="card-body p-3">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">

                <table class="table table-hover table-striped align-middle branch-table">

                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Branch Name</th>
                            <th>Street</th>
                            <th>Area</th>
                            <th>City</th>
                            <th>Post Code</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($branches as $branch)

                        <tr>
                            <td>{{ $branch->BranchID }}</td>
                            <td>{{ $branch->BranchName }}</td>
                            <td>{{ $branch->Street }}</td>
                            <td>{{ $branch->Area }}</td>
                            <td>{{ $branch->City }}</td>
                            <td>{{ $branch->PostCode }}</td>
                            <td>{{ $branch->ContactNo }}</td>
                            <td>{{ $branch->Email }}</td>

                            <td>
                                <div class="d-flex gap-1">

                                    <a href="{{ url('branches/'.$branch->BranchID) }}"
                                       class="btn btn-info btn-sm">
                                        View
                                    </a>

                                    <a href="{{ url('branches/'.$branch->BranchID.'/edit') }}"
                                       class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <form action="{{ url('branches/'.$branch->BranchID) }}"
                                          method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Delete this branch?')">
                                            Delete
                                        </button>

                                    </form>

                                </div>
                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="9" class="text-center text-muted">
                                No branches found
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
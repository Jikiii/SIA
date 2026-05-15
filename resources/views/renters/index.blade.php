<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Renter Management</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

@include('partials.navbar')

<div class="container">

    {{-- HEADER --}}
    <div class="card shadow-sm branch-card">

        <div class="card-header bg-white d-flex justify-content-between align-items-center branch-header">

            <h3 class="mb-0 fw-semibold">Renter Management</h3>

            <a href="{{ url('renters/create') }}" class="btn btn-primary px-4 branch-btn">
                + Add New Renter
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
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Branch</th>
                            <th>Staff</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($renters as $renter)

                        <tr>
                            <td>{{ $renter->RenterID }}</td>
                            <td>{{ $renter->FirstName }}</td>
                            <td>{{ $renter->LastName }}</td>
                            <td>{{ $renter->Address }}</td>
                            <td>{{ $renter->Phone }}</td>

                            <td>{{ $renter->branch->BranchName ?? 'N/A' }}</td>
                            <td>{{ $renter->staff->FirstName ?? 'N/A' }}</td>

                            <td>
                                <div class="d-flex gap-1">

                                    <a href="{{ url('renters/'.$renter->RenterID) }}"
                                       class="btn btn-info btn-sm">
                                        View
                                    </a>

                                    <a href="{{ url('renters/'.$renter->RenterID.'/edit') }}"
                                       class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <form action="{{ url('renters/'.$renter->RenterID) }}"
                                          method="POST"
                                          onsubmit="return confirm('Delete this renter?')">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm">
                                            Delete
                                        </button>

                                    </form>

                                </div>
                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="8" class="text-center text-muted">
                                No renters found
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
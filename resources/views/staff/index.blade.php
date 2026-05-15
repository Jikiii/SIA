<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Management</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

@include('partials.navbar')

<div class="container">

    <div class="card shadow-sm branch-card">

        <div class="card-header bg-white d-flex justify-content-between align-items-center branch-header">

            <h3 class="mb-0 fw-semibold">Staff Management</h3>

            <a href="{{ url('staff/create') }}" class="btn btn-primary px-4 branch-btn">
                + Add Staff
            </a>

        </div>

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
                            <th>Name</th>
                            <th>Position</th>
                            <th>Branch</th>
                            <th>Salary</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($staff as $s)

                        <tr>
                            <td>{{ $s->StaffID }}</td>
                            <td>{{ $s->FirstName }} {{ $s->LastName }}</td>
                            <td>{{ $s->Position }}</td>
                            <td>{{ $s->branch->BranchName ?? 'N/A' }}</td>
                            <td>₱{{ number_format($s->Salary, 2) }}</td>

                            <td>
                                <div class="d-flex gap-1">

                                    <a href="{{ url('staff/'.$s->StaffID) }}"
                                       class="btn btn-info btn-sm">
                                        View
                                    </a>

                                    <a href="{{ url('staff/'.$s->StaffID.'/edit') }}"
                                       class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <form action="{{ url('staff/'.$s->StaffID) }}"
                                          method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Delete this staff?')">
                                            Delete
                                        </button>

                                    </form>

                                </div>
                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                No staff found
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

</body>
</html>
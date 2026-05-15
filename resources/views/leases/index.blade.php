<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lease Management</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>

@include('partials.navbar')

<div class="container">

    {{-- HEADER --}}
    <div class="card shadow-sm branch-card">

        <div class="card-header bg-white d-flex justify-content-between align-items-center branch-header">

            <h3 class="mb-0 fw-semibold">Lease Agreements</h3>

            <a href="{{ url('leases/create') }}" class="btn btn-primary px-4 branch-btn">
                + Add New Lease
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
                            <th>Property</th>
                            <th>Renter</th>
                            <th>Staff</th>
                            <th>Rent</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($leases as $lease)

                        @php
                            $status = (strtotime($lease->EndDate) < time()) ? 'Expired' : 'Active';
                            $color = $status == 'Active' ? 'success' : 'secondary';
                        @endphp

                        <tr>
                            <td>{{ $lease->LeaseID }}</td>

                            <td>
                                {{ $lease->property->StreetName ?? 'N/A' }}
                            </td>

                            <td>
                                {{ $lease->renter->FirstName ?? '' }}
                                {{ $lease->renter->LastName ?? '' }}
                            </td>

                            <td>
                                {{ $lease->staff->FirstName ?? 'N/A' }}
                            </td>

                            <td>₱{{ number_format($lease->Rent, 2) }}</td>

                            <td>{{ $lease->StartDate }}</td>
                            <td>{{ $lease->EndDate }}</td>

                            <td>
                                <span class="badge bg-{{ $color }}">
                                    {{ $status }}
                                </span>
                            </td>

                            <td class="d-flex gap-1">

                                <a href="{{ url('leases/'.$lease->LeaseID) }}"
                                   class="btn btn-info btn-sm">
                                    View
                                </a>

                                <a href="{{ url('leases/'.$lease->LeaseID.'/edit') }}"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ url('leases/'.$lease->LeaseID) }}"
                                      method="POST"
                                      onsubmit="return confirm('Delete this lease?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm">
                                        Delete
                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="9" class="text-center text-muted">
                                No leases found
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
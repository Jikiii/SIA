<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Property Management</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

@include('partials.navbar')

<div class="container">

    <div class="card shadow-sm branch-card">

        <!-- HEADER -->
        <div class="card-header bg-white d-flex justify-content-between align-items-center branch-header">

            <h3 class="mb-0 fw-semibold">Property Management</h3>

            <a href="{{ url('properties/create') }}"
               class="btn btn-primary px-4 branch-btn">
                + Add Property
            </a>

        </div>

        <!-- TABLE -->
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
                            <th>Address</th>
                            <th>City</th>
                            <th>Rooms</th>
                            <th>Rent</th>
                            <th>Manager</th>
                            <th>Branch</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($properties as $p)

                        <tr>
                            <td>{{ $p->PropertyID }}</td>
                            <td>{{ $p->StreetName }}</td>
                            <td>{{ $p->City }}</td>
                            <td>{{ $p->Rooms }}</td>
                            <td>₱{{ number_format($p->RentAmount, 2) }}</td>

                            <td>{{ $p->staff->FirstName ?? '-' }} {{ $p->staff->LastName ?? '' }}</td>

                            <td>{{ $p->branch->BranchName ?? '-' }}</td>

                            <td>
                                @php
                                    $color = match($p->Status) {
                                        'Available' => 'success',
                                        'Rented' => 'warning',
                                        'Withdrawn' => 'danger',
                                        default => 'secondary'
                                    };
                                @endphp

                                <span class="badge bg-{{ $color }}">
                                    {{ $p->Status }}
                                </span>
                            </td>

                            <td>
                                <div class="d-flex gap-1">

                                    <a href="{{ url('properties/'.$p->PropertyID) }}"
                                       class="btn btn-info btn-sm">
                                        View
                                    </a>

                                    <a href="{{ url('properties/'.$p->PropertyID.'/edit') }}"
                                       class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <form action="{{ url('properties/'.$p->PropertyID) }}"
                                          method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Withdraw this property?')">
                                            Withdraw
                                        </button>

                                    </form>

                                </div>
                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="9" class="text-center text-muted">
                                No properties found
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renter Details: {{ $renter->FirstName }} {{ $renter->LastName }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Renter Details: {{ $renter->FirstName }} {{ $renter->LastName }}</h2>
        </div>
        <div class="card-body">

            <div class="row">
                <!-- Personal Information -->
                <div class="col-md-6">
                    <h4>Personal Information</h4>
                    <table class="table table-bordered">
                        <tr><th width="200">Renter Number</th><td>{{ $renter->RenterID }}</td></tr>
                        <tr><th>Full Name</th><td>{{ $renter->FirstName }} {{ $renter->LastName }}</td></tr>
                        <tr><th>Address</th><td>{{ $renter->Address }}</td></tr>
                        <tr><th>Phone</th><td>{{ $renter->Phone }}</td></tr>
                    </table>
                </div>

                <!-- Property Requirements -->
                <div class="col-md-6">
                    <h4>Property Requirements</h4>
                    <table class="table table-bordered">
                        <tr><th width="200">Preferred Type</th><td>{{ $renter->PreferredType ?? 'Any' }}</td></tr>
                        <tr><th>Maximum Budget</th><td>£{{ number_format($renter->MaxBudget, 2) ?? 'N/A' }}</td></tr>
                        <tr><th>Notes</th><td>{{ $renter->Notes ?? 'N/A' }}</td></tr>
                        <tr><th>Branch</th><td>{{ $renter->branch->BranchName ?? 'N/A' }} - {{ $renter->branch->City ?? 'N/A' }}</td></tr>
                    </table>
                </div>
            </div>

            <!-- Lease History -->
            @if($renter->leases->count() > 0)
            <div class="row mt-4">
                <div class="col-12">
                    <h4>Lease History</h4>
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Lease No</th>
                                <th>Property</th>
                                <th>Address</th>
                                <th>Rent</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($renter->leases as $lease)
                                @php
                                    $status = $lease->EndDate < now() ? 'Expired' : 'Active';
                                @endphp
                                <tr>
                                    <td>{{ $lease->LeaseID }}</td>
                                    <td>{{ $lease->property->PropertyType ?? 'N/A' }}</td>
                                    <td>{{ $lease->property->StreetName ?? 'N/A' }}, {{ $lease->property->City ?? 'N/A' }}</td>
                                    <td>£{{ number_format($lease->Rent, 2) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($lease->StartDate)->format('Y-m-d') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($lease->EndDate)->format('Y-m-d') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $status == 'Active' ? 'success' : 'secondary' }}">
                                            {{ $status }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            <div class="mt-3">
                <a href="{{ route('renters.index') }}" class="btn btn-secondary">Back to List</a>
                <a href="{{ route('renters.edit', $renter->RenterID) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('properties.index') }}" class="btn btn-primary">Find Properties</a>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
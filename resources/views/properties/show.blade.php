<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Property Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="bg-light">

<div class="container py-5">

    <div class="card shadow-sm">

        <!-- HEADER -->
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h4 class="mb-0">Property Details</h4>
                <small>Property ID: {{ $property->PropertyID }}</small>
            </div>
            <span class="badge rounded-pill px-3 py-2
                @if($property->current_status == 'Available') bg-success
                @elseif($property->current_status == 'Rented') bg-warning text-dark
                @else bg-danger @endif">
                {{ $property->current_status }}
            </span>
        </div>

        <div class="card-body">

            <!-- PROPERTY INFO -->
            <h5 class="text-primary mb-3">Property Information</h5>
            <div class="row mb-2">
                <div class="col-md-6">
                    <div><strong>Street Name:</strong> {{ $property->StreetName }}</div>
                    <div><strong>City:</strong> {{ $property->City }}</div>
                    <div><strong>Monthly Rent:</strong> ₱{{ number_format($property->RentAmount, 2) }}</div>
                </div>
                <div class="col-md-6">
                    <div><strong>District:</strong> {{ $property->District ?? 'N/A' }}</div>
                    <div><strong>Postal Code:</strong> {{ $property->PostalCode }}</div>
                    <div><strong>Property Type:</strong> {{ $property->type->TypeName ?? 'N/A' }}</div>
                    <div><strong>Rooms:</strong> {{ $property->Rooms }}</div>
                </div>
            </div>

            <hr>

            <!-- MANAGEMENT INFO -->
            <h5 class="text-primary mb-3">Management Information</h5>
            <div class="row mb-2">
                <div class="col-md-6">
                    <div><strong>Managing Staff:</strong> {{ $property->staff->FirstName ?? 'N/A' }} {{ $property->staff->LastName ?? '' }}</div>
                </div>
                <div class="col-md-6">
                    <div><strong>Owner:</strong> {{ $property->owner->FullName ?? 'N/A' }}</div>
                </div>
            </div>

            <hr>

            <!-- LEASE HISTORY -->
            <h5 class="text-primary mb-2">Lease History ({{ $property->leases->count() }})</h5>
            <div class="table-responsive mb-4">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Renter</th>
                            <th>Rent</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($property->leases as $lease)
                        <tr>
                            <td>{{ $lease->renter->FirstName ?? '' }} {{ $lease->renter->LastName ?? '' }}</td>
                            <td>₱{{ number_format($lease->Rent, 2) }}</td>
                            <td>{{ \Carbon\Carbon::parse($lease->StartDate)->format('Y-m-d') }}</td>
                            <td>{{ \Carbon\Carbon::parse($lease->EndDate)->format('Y-m-d') }}</td>
                            <td>
                                <span class="badge
                                    @if($lease->Status == 'Active') bg-success
                                    @elseif($lease->Status == 'Expired') bg-secondary
                                    @else bg-danger @endif">
                                    {{ $lease->Status }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No lease history found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- INSPECTION HISTORY -->
            <h5 class="text-primary mb-2">Inspection History ({{ $property->inspections->count() }})</h5>
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Inspector</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($property->inspections as $inspection)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($inspection->InspectDate)->format('Y-m-d') }}</td>
                            <td>{{ $inspection->staff->FirstName ?? '' }} {{ $inspection->staff->LastName ?? '' }}</td>
                            <td>{{ $inspection->Notes ?? 'No notes available' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">No inspection records found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

        <!-- FOOTER -->
        <div class="card-footer d-flex gap-2">
            <a href="{{ route('properties.index') }}" class="btn btn-secondary">Back</a>
            <a href="{{ route('properties.edit', $property->PropertyID) }}" class="btn btn-warning">Edit Property</a>
        </div>
    </div>

</div>

</body>
</html>
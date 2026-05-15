<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lease Agreement Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">

    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Lease Agreement Details</h2>
        </div>
        <div class="card-body">

            <div class="row">

                {{-- Lease Information --}}
                <div class="col-md-6">
                    <h4>Lease Information</h4>
                    <table class="table table-bordered">
                        <tr>
                            <th width="200">Lease Number</th>
                            <td>{{ $lease->LeaseID }}</td>
                        </tr>
                        <tr>
                            <th>Property</th>
                            <td>{{ $lease->property->type->TypeName ?? 'N/A' }} - {{ $lease->property->StreetName }}, {{ $lease->property->City }}</td>
                        </tr>
                        <tr>
                            <th>Property Address</th>
                            <td>
                                {{ $lease->property->StreetName }}<br>
                                {{ $lease->property->District ?? '' }}<br>
                                {{ $lease->property->City }}<br>
                                {{ $lease->property->PostalCode ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>Rooms</th>
                            <td>{{ $lease->property->Rooms ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Monthly Rent</th>
                            <td>₱{{ number_format($lease->Rent, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Payment Method</th>
                            <td>{{ $lease->PaymentMethod ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Deposit Amount</th>
                            <td>₱{{ number_format($lease->DepositAmount ?? 0, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Deposit Paid</th>
                            <td>{{ $lease->IsDepositPaid ? 'Yes' : 'No' }}</td>
                        </tr>
                        <tr>
                            <th>Start Date</th>
                            <td>{{ \Carbon\Carbon::parse($lease->StartDate)->format('Y-m-d') }}</td>
                        </tr>
                        <tr>
                            <th>End Date</th>
                            <td>{{ \Carbon\Carbon::parse($lease->EndDate)->format('Y-m-d') }}</td>
                        </tr>
                        <tr>
                            <th>Duration</th>
                            <td>{{ $lease->LeaseDuration }} month(s)</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge {{ $lease->current_status == 'Active' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $lease->current_status }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Arranged By</th>
                            <td>{{ $lease->staff->FirstName ?? '' }} {{ $lease->staff->LastName ?? '' }}</td>
                        </tr>
                    </table>
                </div>

                {{-- Renter Information --}}
                <div class="col-md-6">
                    <h4>Renter Information</h4>
                    <table class="table table-bordered">
                        <tr>
                            <th width="200">Renter Name</th>
                            <td>{{ $lease->renter->FirstName ?? '' }} {{ $lease->renter->LastName ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $lease->renter->Address ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $lease->renter->Phone ?? 'N/A' }}</td>
                        </tr>
                    </table>
                </div>

            </div>

            {{-- Inspection History --}}
            @if($lease->property->inspections->count() > 0)
            <div class="row mt-4">
                <div class="col-12">
                    <h4>Property Inspection History</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Inspector</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lease->property->inspections as $inspection)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($inspection->InspectDate)->format('Y-m-d') }}</td>
                                <td>{{ $inspection->staff->FirstName ?? '' }} {{ $inspection->staff->LastName ?? '' }}</td>
                                <td>{{ $inspection->Notes ?? 'No notes' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            {{-- Action Buttons --}}
            <div class="mt-3">
                <a href="{{ route('leases.index') }}" class="btn btn-secondary">Back to List</a>
                <a href="{{ route('leases.edit', $lease->LeaseID) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('inspections.create', $lease->PropertyID) }}" class="btn btn-info">Add Inspection</a>
            </div>

        </div>
    </div>

</div>

</body>
</html>
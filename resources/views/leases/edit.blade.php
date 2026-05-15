<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lease Agreement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">

    <div class="card">
        <div class="card-header">
            <h2>Edit Lease Agreement</h2>
        </div>
        <div class="card-body">

            {{-- Validation errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('leases.update', $lease->LeaseID) }}">
                @csrf
                @method('PUT')

                {{-- Hidden Lease ID --}}
                <input type="hidden" name="lease_id" value="{{ $lease->LeaseID }}">

                <div class="row">

                    {{-- Property --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Property *</label>
                        <select class="form-select" name="property_id" required>
                            @foreach($properties as $property)
                                <option value="{{ $property->PropertyID }}"
                                    {{ $lease->PropertyID == $property->PropertyID ? 'selected' : '' }}>
                                    {{ $property->StreetName }}, {{ $property->City }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Renter --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Renter *</label>
                        <select class="form-select" name="renter_id" required>
                            @foreach($renters as $renter)
                                <option value="{{ $renter->RenterID }}"
                                    {{ $lease->RenterID == $renter->RenterID ? 'selected' : '' }}>
                                    {{ $renter->FirstName }} {{ $renter->LastName }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Monthly Rent (read-only) --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Monthly Rent (£)</label>
                        <input type="number" class="form-control" value="{{ number_format($lease->Rent, 2) }}" readonly>
                    </div>

                    {{-- Payment Method --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Payment Method *</label>
                        <select class="form-select" name="payment_method" required>
                            @php
                                $methods = ['Bank Transfer', 'Cheque', 'Cash', 'Direct Debit'];
                            @endphp
                            @foreach($methods as $method)
                                <option value="{{ $method }}" {{ $lease->PaymentMethod === $method ? 'selected' : '' }}>{{ $method }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Deposit Amount --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Deposit Amount (£)</label>
                        <input type="number" class="form-control" name="deposit_amount" value="{{ old('deposit_amount', $lease->DepositAmount) }}" step="0.01">
                    </div>

                    {{-- Deposit Paid --}}
                    <div class="col-md-6 mb-3">
                        <div class="form-check mt-4">
                            <input class="form-check-input" type="checkbox" name="is_deposit_paid" id="depositPaid" value="1" {{ $lease->IsDepositPaid ? 'checked' : '' }}>
                            <label class="form-check-label" for="depositPaid">Deposit Paid</label>
                        </div>
                    </div>

                    {{-- Start Date --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Start Date *</label>
                        <input type="date" class="form-control" name="start_date" value="{{ old('start_date', \Carbon\Carbon::parse($lease->StartDate)->format('Y-m-d')) }}" required>
                    </div>

                    {{-- End Date --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">End Date *</label>
                        <input type="date" class="form-control" name="end_date" value="{{ old('end_date', \Carbon\Carbon::parse($lease->EndDate)->format('Y-m-d')) }}" required>
                    </div>

                    {{-- Arranged By (Staff) --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Arranged By (Staff) *</label>
                        <select class="form-select" name="staff_id" required>
                            @foreach($staff as $member)
                                <option value="{{ $member->StaffID }}" {{ $lease->StaffID == $member->StaffID ? 'selected' : '' }}>
                                    {{ $member->FirstName }} {{ $member->LastName }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <button type="submit" class="btn btn-primary">Update Lease</button>
                <a href="{{ route('leases.index') }}" class="btn btn-secondary">Cancel</a>
            </form>

        </div>
    </div>

</div>

</body>
</html> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Lease Agreement</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Create New Lease Agreement</h2>
        </div>
        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('leases.store') }}">
                @csrf

                <div class="row">

                    <!-- Property -->
<div class="col-md-4 mb-3">
    <label class="form-label">Property *</label>
    <select name="property_id" id="propertySelect" class="form-select" required>
        <option value="">Select Property</option>
        @foreach($properties as $property)
            @if($property->current_status === 'Available') <!-- Only show available properties -->
            <option value="{{ $property->PropertyID }}" data-rent="{{ $property->RentAmount }}">
                {{ $property->PropertyID }} - {{ $property->type->TypeName ?? 'N/A' }} - {{ $property->StreetName }}, {{ $property->City }}
            </option>
            @endif
        @endforeach
    </select>
</div>

                    <!-- Renter -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Renter *</label>
                        <select name="renter_id" class="form-select" required>
                            <option value="">Select Renter</option>
                            @foreach($renters as $renter)
                                <option value="{{ $renter->RenterID }}">
                                    {{ $renter->FirstName }} {{ $renter->LastName }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Staff -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Staff *</label>
                        <select name="staff_id" class="form-select" required>
                            <option value="">Select Staff</option>
                            @foreach($staff as $s)
                                <option value="{{ $s->StaffID }}">
                                    {{ $s->FirstName }} {{ $s->LastName }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Rent -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Monthly Rent (£) *</label>
                        <input type="number" name="rent" id="monthlyRent" class="form-control" step="0.01" required>
                    </div>

                    <!-- Payment Method -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Payment Method *</label>
                        <select name="payment_method" class="form-select" required>
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="Cash">Cash</option>
                            <option value="Cheque">Cheque</option>
                            <option value="Direct Debit">Direct Debit</option>
                        </select>
                    </div>

                    <!-- Deposit -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Deposit (£)</label>
                        <input type="number" name="deposit_amount" class="form-control" step="0.01">
                    </div>

                    <!-- Deposit Paid -->
                    <div class="col-md-4 mb-3 mt-3">
                        <div class="form-check">
                            <input type="checkbox" name="is_deposit_paid" class="form-check-input">
                            <label class="form-check-label">Deposit Paid</label>
                        </div>
                    </div>

                    <!-- Start Date -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Start Date *</label>
                        <input type="date" name="start_date" id="startDate" class="form-control" required>
                    </div>

                    <!-- End Date -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">End Date *</label>
                        <input type="date" name="end_date" id="endDate" class="form-control" required>
                    </div>

                    <!-- Duration -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Duration</label>
                        <input type="text" id="duration" class="form-control" readonly>
                    </div>

                </div>

                <button type="submit" class="btn btn-primary">Create Lease</button>
                <a href="{{ route('leases.index') }}" class="btn btn-secondary">Cancel</a>
            </form>

        </div>
    </div>
</div>

<script>
// Auto-fill rent based on selected property
document.getElementById('propertySelect').addEventListener('change', function() {
    const rentField = document.getElementById('monthlyRent');
    const rent = this.selectedOptions[0].dataset.rent;
    rentField.value = rent;
});

// Calculate duration in months
function calcDuration() {
    const start = new Date(document.getElementById('startDate').value);
    const end = new Date(document.getElementById('endDate').value);
    if (start && end && end > start) {
        const months = (end.getFullYear() - start.getFullYear()) * 12 + (end.getMonth() - start.getMonth());
        document.getElementById('duration').value = months + ' months';
    } else {
        document.getElementById('duration').value = '';
    }
}

document.getElementById('startDate').addEventListener('change', calcDuration);
document.getElementById('endDate').addEventListener('change', calcDuration);
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
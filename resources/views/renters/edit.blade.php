<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Renter: {{ $renter->FirstName }} {{ $renter->LastName }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Edit Renter: {{ $renter->FirstName }} {{ $renter->LastName }}</h2>
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

            <form method="POST" action="{{ route('renters.update', $renter->RenterID) }}">
                @csrf
                @method('PUT')

                <div class="row">

                    <!-- First Name -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">First Name *</label>
                        <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $renter->FirstName) }}" required maxlength="50">
                    </div>

                    <!-- Last Name -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Last Name *</label>
                        <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $renter->LastName) }}" required maxlength="50">
                    </div>

                    <!-- Address -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Address *</label>
                        <textarea name="address" class="form-control" rows="2" required>{{ old('address', $renter->Address) }}</textarea>
                    </div>

                    <!-- Phone -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Phone *</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $renter->Phone) }}" required maxlength="20">
                    </div>

                    <!-- Date Approved -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Date Approved *</label>
                        <input type="date" name="date_approved" class="form-control" value="{{ old('date_approved', $renter->DateApproved) }}" required>
                    </div>

                    <!-- Branch -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Branch *</label>
                        <select name="branch_id" class="form-select" required>
                            <option value="">Select Branch</option>
                            @foreach($branches as $branch)
                                <option value="{{ $branch->BranchID }}" {{ old('branch_id', $renter->BranchID) == $branch->BranchID ? 'selected' : '' }}>
                                    {{ $branch->BranchName }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Staff -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Assigned Staff *</label>
                        <select name="staff_id" class="form-select" required>
                            <option value="">Select Staff</option>
                            @foreach($staff as $s)
                                <option value="{{ $s->StaffID }}" {{ old('staff_id', $renter->StaffID) == $s->StaffID ? 'selected' : '' }}>
                                    {{ $s->FirstName }} {{ $s->LastName }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Optional Fields -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Preferred Property Type</label>
                        <select name="preferred_type" class="form-select">
                            <option value="">Any</option>
                            <option value="Flat" {{ old('preferred_type', $renter->PreferredType) == 'Flat' ? 'selected' : '' }}>Flat</option>
                            <option value="House" {{ old('preferred_type', $renter->PreferredType) == 'House' ? 'selected' : '' }}>House</option>
                            <option value="Apartment" {{ old('preferred_type', $renter->PreferredType) == 'Apartment' ? 'selected' : '' }}>Apartment</option>
                            <option value="Studio" {{ old('preferred_type', $renter->PreferredType) == 'Studio' ? 'selected' : '' }}>Studio</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Maximum Budget (£)</label>
                        <input type="number" name="max_budget" class="form-control" value="{{ old('max_budget', $renter->MaxBudget) }}" step="50">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Notes</label>
                        <input type="text" name="notes" class="form-control" value="{{ old('notes', $renter->Notes) }}">
                    </div>

                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Update Renter</button>
                    <a href="{{ route('renters.index') }}" class="btn btn-secondary">Cancel</a>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
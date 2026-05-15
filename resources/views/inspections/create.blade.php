<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Inspection</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4">

<h2>Record Property Inspection</h2>

<form method="POST" action="{{ route('inspections.store') }}">
    @csrf

    <!-- Property & Staff -->
    <div class="row mb-3">
        <!-- Property Dropdown -->
        <div class="col-md-6">
            <label>Property *</label>
            <select name="property_id" class="form-select" required>
                <option value="">Select Property</option>
                @foreach($properties as $property)
                    <option value="{{ $property->PropertyID }}">
                        {{ $property->PropertyID }} - {{ $property->propertyType?->TypeName ?? 'N/A' }} - {{ $property->StreetName }}, {{ $property->City }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Staff Dropdown -->
        <div class="col-md-6">
            <label>Inspector (Staff) *</label>
            <select name="staff_id" class="form-select" required>
                <option value="">Select Staff</option>
                @foreach($staff as $member)
                    <option value="{{ $member->StaffID }}">
                        {{ $member->FirstName }} {{ $member->LastName }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Inspection Date -->
    <div class="row mb-3">
        <div class="col-md-6">
            <label>Inspection Date *</label>
            <input type="date" name="inspect_date" class="form-control" required>
        </div>
    </div>

    <!-- Notes -->
    <div class="mb-3">
        <label>Notes *</label>
        <textarea name="notes" class="form-control" rows="4" required placeholder="Describe the property condition, repairs, etc."></textarea>
    </div>

    <!-- Buttons -->
    <button type="submit" class="btn btn-primary">Save Inspection</button>
    <a href="{{ route('inspections.index') }}" class="btn btn-secondary">Cancel</a>

</form>

</body>
</html>
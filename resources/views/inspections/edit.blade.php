<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Inspection</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4">

<h2>Edit Inspection: {{ $inspection->InspectionID }}</h2>

<form method="POST" action="{{ route('inspections.update', $inspection->InspectionID) }}">
    @csrf
    @method('PUT')

    <div class="row mb-3">
        <div class="col-md-6">
            <label>Property</label>
            <input type="text" class="form-control" value="{{ $inspection->property->PropertyNo ?? '' }}" readonly disabled>
        </div>
        <div class="col-md-6">
            <label>Inspector *</label>
            <select name="staff_id" class="form-select" required>
                @foreach($staff as $member)
                <option value="{{ $member->StaffID }}" {{ $inspection->StaffID == $member->StaffID ? 'selected' : '' }}>
                    {{ $member->FName }} {{ $member->LName }}
                </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label>Inspection Date *</label>
            <input type="date" name="inspect_date" class="form-control" value="{{ $inspection->InspectDate }}" required>
        </div>
    </div>

    <div class="mb-3">
        <label>Notes *</label>
        <textarea name="notes" class="form-control" rows="4" required>{{ $inspection->Notes }}</textarea>
    </div>

    <button class="btn btn-primary">Update Inspection</button>
    <a href="{{ route('inspections.show', $inspection->InspectionID) }}" class="btn btn-secondary">Cancel</a>
</form>

</body>
</html>
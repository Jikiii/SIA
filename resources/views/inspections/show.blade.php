<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inspection Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4">

<h2>Inspection Details: {{ $inspection->InspectionID }}</h2>

<div class="row mb-3">
    <div class="col-md-6">
        <h4>Property Information</h4>
        <table class="table table-bordered">
            <tr><th>Property Number</th><td>{{ $inspection->property->PropertyNo ?? '' }}</td></tr>
            <tr><th>Property Type</th><td>{{ $inspection->property->PropertyType ?? '' }}</td></tr>
            <tr><th>Address</th>
                <td>
                    {{ $inspection->property->StreetName ?? '' }}<br>
                    {{ $inspection->property->District ?? '' }}<br>
                    {{ $inspection->property->City ?? '' }}<br>
                    {{ $inspection->property->PostCode ?? '' }}
                </td>
            </tr>
        </table>
    </div>
    <div class="col-md-6">
        <h4>Inspection Information</h4>
        <table class="table table-bordered">
            <tr><th>Inspection ID</th><td>{{ $inspection->InspectionID }}</td></tr>
            <tr><th>Inspection Date</th><td>{{ $inspection->InspectDate }}</td></tr>
            <tr><th>Inspector</th><td>{{ $inspection->staff->FName ?? '' }} {{ $inspection->staff->LName ?? '' }}</td></tr>
        </table>
    </div>
</div>

<h4>Inspection Notes</h4>
<div class="card mb-3">
    <div class="card-body">
        {!! nl2br(e($inspection->Notes)) !!}
    </div>
</div>

<a href="{{ route('inspections.index') }}" class="btn btn-secondary">Back to List</a>
<a href="{{ route('inspections.edit', $inspection->InspectionID) }}" class="btn btn-warning">Edit</a>
<a href="{{ route('properties.show', $inspection->PropertyID ?? 0) }}" class="btn btn-info">View Property</a>

</body>
</html>
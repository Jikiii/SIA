<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Branch</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4">

<h2>Edit Branch: {{ $branch->BranchID }}</h2>

<form method="POST" action="{{ route('branches.update', $branch->BranchID) }}">
    @csrf
    @method('PUT')

    <div class="row mb-3">
        <div class="col-md-6">
            <label>Branch Name *</label>
            <input type="text" name="BranchName" class="form-control" value="{{ $branch->BranchName }}" required>
        </div>
        <div class="col-md-6">
            <label>Street *</label>
            <input type="text" name="Street" class="form-control" value="{{ $branch->Street }}" required>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label>Area</label>
            <input type="text" name="Area" class="form-control" value="{{ $branch->Area }}">
        </div>
        <div class="col-md-6">
            <label>City *</label>
            <input type="text" name="City" class="form-control" value="{{ $branch->City }}" required>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <label>Postcode *</label>
            <input type="text" name="PostCode" class="form-control" value="{{ $branch->PostCode }}" required>
        </div>
        <div class="col-md-4">
            <label>Contact No *</label>
            <input type="text" name="ContactNo" class="form-control" value="{{ $branch->ContactNo }}" required>
        </div>
        <div class="col-md-4">
            <label>Email</label>
            <input type="email" name="Email" class="form-control" value="{{ $branch->Email }}">
        </div>
    </div>

    <button class="btn btn-primary">Update Branch</button>
    <a href="{{ route('branches.index') }}" class="btn btn-secondary">Cancel</a>
</form>

</body>
</html>
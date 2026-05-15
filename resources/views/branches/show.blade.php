<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Branch</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4">

<h2>Branch Details: {{ $branch->BranchID }}</h2>

<table class="table table-bordered">
    <tr><th>Branch Name</th><td>{{ $branch->BranchName }}</td></tr>
    <tr><th>Street</th><td>{{ $branch->Street }}</td></tr>
    <tr><th>Area</th><td>{{ $branch->Area }}</td></tr>
    <tr><th>City</th><td>{{ $branch->City }}</td></tr>
    <tr><th>Postcode</th><td>{{ $branch->PostCode }}</td></tr>
    <tr><th>Contact No</th><td>{{ $branch->ContactNo }}</td></tr>
    <tr><th>Email</th><td>{{ $branch->Email }}</td></tr>
</table>

<a href="{{ route('branches.index') }}" class="btn btn-secondary">Back</a>
<a href="{{ route('branches.edit', $branch->BranchID) }}" class="btn btn-warning">Edit</a>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Details</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- YOUR GLOBAL CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

<div class="container py-5">

    <div class="custom-card">

        <div class="custom-card-header">
            Staff Details: {{ $staff->FirstName }} {{ $staff->LastName }}
        </div>

        <div class="p-4">

            <div class="row">

                <!-- PERSONAL INFO -->
                <div class="col-md-6">

                    <h5>Personal Information</h5>

                    <table class="table table-bordered">

                        <tr>
                            <th>Staff ID</th>
                            <td>{{ $staff->StaffID }}</td>
                        </tr>

                        <tr>
                            <th>Full Name</th>
                            <td>{{ $staff->FirstName }} {{ $staff->LastName }}</td>
                        </tr>

                        <tr>
                            <th>Address</th>
                            <td>{{ $staff->Address }}</td>
                        </tr>

                        <tr>
                            <th>Phone</th>
                            <td>{{ $staff->Phone }}</td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td>{{ $staff->Email }}</td>
                        </tr>

                        <tr>
                            <th>Gender</th>
                            <td>{{ $staff->Gender }}</td>
                        </tr>

                        <tr>
                            <th>Birth Date</th>
                            <td>{{ $staff->BirthDate }}</td>
                        </tr>

                    </table>

                </div>

                <!-- JOB INFO -->
                <div class="col-md-6">

                    <h5>Employment Information</h5>

                    <table class="table table-bordered">

                        <tr>
                            <th>Position</th>
                            <td>{{ $staff->Position }}</td>
                        </tr>

                        <tr>
                            <th>Salary</th>
                            <td>₱{{ number_format($staff->Salary, 2) }}</td>
                        </tr>

                        <tr>
                            <th>Hire Date</th>
                            <td>{{ $staff->HireDate }}</td>
                        </tr>

                        <tr>
                            <th>Branch</th>
                            <td>{{ $staff->branch->BranchName ?? 'N/A' }}</td>
                        </tr>

                    </table>

                </div>

            </div>

            <div class="mt-3 d-flex gap-2">

                <a href="{{ route('staff.index') }}" class="btn btn-secondary">
                    Back
                </a>

                <a href="{{ route('staff.edit', $staff->StaffID) }}" class="btn btn-warning">
                    Edit
                </a>

            </div>

        </div>

    </div>

</div>

</body>
</html>
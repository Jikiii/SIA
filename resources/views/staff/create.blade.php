<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Staff</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- GLOBAL CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="container py-5">

    <div class="custom-card">

        <!-- HEADER -->
        <div class="custom-card-header">
            Add New Staff Member
        </div>

        <div class="p-4">

            <form method="POST" action="{{ route('staff.store') }}">
                @csrf

                <!-- PERSONAL INFO -->
                <div class="form-section-title">Personal Information</div>

                <div class="row g-3">

                    <div class="col-md-6">
                        <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                    </div>

                    <div class="col-md-6">
                        <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                    </div>

                    <div class="col-12">
                        <textarea name="address" class="form-control" rows="2" placeholder="Address" required></textarea>
                    </div>

                </div>

                <hr>

                <!-- CONTACT INFO -->
                <div class="form-section-title">Contact Information</div>

                <div class="row g-3">

                    <div class="col-md-4">
                        <input type="text" name="telephone" class="form-control" placeholder="Telephone" required>
                    </div>

                    <div class="col-md-4">
                        <input type="email" name="email" class="form-control" placeholder="Email">
                    </div>

                    <div class="col-md-4">
                        <select name="sex" class="form-select" required>
                            <option value="">Gender</option>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <input type="date" name="date_of_birth" class="form-control" required>
                    </div>

                    

                </div>

                <hr>

                <!-- JOB INFO -->
                <div class="form-section-title">Job Information</div>

                <div class="row g-3">

                    <div class="col-md-4">
                        <select name="job_title" id="jobTitle" class="form-select" required>
                            <option value="">Select Job</option>
                            <option value="Manager">Manager</option>
                            <option value="Supervisor">Supervisor</option>
                            <option value="Staff">Staff</option>
                            <option value="Secretary">Secretary</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <input type="number" name="salary" class="form-control" placeholder="Salary" required>
                    </div>

                    <div class="col-md-4">
                        <input type="date" name="date_joined" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <select name="branch_no" class="form-select" required>
                            <option value="">Select Branch</option>
                            @foreach($branches as $branch)
                                <option value="{{ $branch->BranchID }}">
                                    {{ $branch->BranchName }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <!-- BUTTONS -->
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4">
                        Save Staff
                    </button>

                    <a href="{{ route('staff.index') }}" class="btn btn-secondary px-4">
                        Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

</body>
</html>
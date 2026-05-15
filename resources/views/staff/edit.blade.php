<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Staff</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="container py-5">

    <div class="custom-card">

        <!-- HEADER -->
        <div class="custom-card-header">
            Edit Staff Member
        </div>

        <div class="p-4">

            <form method="POST" action="{{ route('staff.update', $staff->StaffID) }}">
                @csrf
                @method('PUT')

                <!-- PERSONAL INFO -->
                <div class="form-section-title">Personal Information</div>

                <div class="row g-3">

                    <div class="col-md-6">
                        <input type="text"
                               name="first_name"
                               class="form-control"
                               value="{{ $staff->FirstName }}"
                               required>
                    </div>

                    <div class="col-md-6">
                        <input type="text"
                               name="last_name"
                               class="form-control"
                               value="{{ $staff->LastName }}"
                               required>
                    </div>

                    <div class="col-12">
                        <textarea name="address"
                                  class="form-control"
                                  rows="2"
                                  required>{{ $staff->Address }}</textarea>
                    </div>

                </div>

                <hr>

                <!-- CONTACT INFO -->
                <div class="form-section-title">Contact Information</div>

                <div class="row g-3">

                    <div class="col-md-4">
                        <input type="text"
                               name="telephone"
                               class="form-control"
                               value="{{ $staff->Phone }}"
                               required>
                    </div>

                    <div class="col-md-4">
                        <input type="email"
                               name="email"
                               class="form-control"
                               value="{{ $staff->Email }}">
                    </div>

                    <div class="col-md-4">
                        <select name="sex" class="form-select" required>
                            <option value="M" {{ $staff->Gender == 'M' ? 'selected' : '' }}>Male</option>
                            <option value="F" {{ $staff->Gender == 'F' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <input type="date"
                               name="date_of_birth"
                               class="form-control"
                               value="{{ $staff->BirthDate }}"
                               required>
                    </div>

                </div>

                <hr>

                <!-- JOB INFO -->
                <div class="form-section-title">Job Information</div>

                <div class="row g-3">

                    <div class="col-md-4">
                        <select name="job_title" class="form-select" required>

                            <option value="Manager" {{ $staff->Position == 'Manager' ? 'selected' : '' }}>
                                Manager
                            </option>

                            <option value="Supervisor" {{ $staff->Position == 'Supervisor' ? 'selected' : '' }}>
                                Supervisor
                            </option>

                            <option value="Staff" {{ $staff->Position == 'Staff' ? 'selected' : '' }}>
                                Staff
                            </option>

                            <option value="Secretary" {{ $staff->Position == 'Secretary' ? 'selected' : '' }}>
                                Secretary
                            </option>

                            <option value="Administrator" {{ $staff->Position == 'Administrator' ? 'selected' : '' }}>
                                Administrator
                            </option>

                        </select>
                    </div>

                    <div class="col-md-4">
                        <input type="number"
                               name="salary"
                               class="form-control"
                               value="{{ $staff->Salary }}"
                               required>
                    </div>

                    <div class="col-md-4">
                        <input type="date"
                               name="date_joined"
                               class="form-control"
                               value="{{ $staff->HireDate }}"
                               required>
                    </div>

                    <div class="col-md-4">
                        <select name="branch_no" class="form-select" required>

                            @foreach($branches as $branch)
                                <option value="{{ $branch->BranchID }}"
                                    {{ $staff->BranchID == $branch->BranchID ? 'selected' : '' }}>
                                    {{ $branch->BranchName }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                </div>

                <!-- BUTTONS -->
                <div class="mt-4 d-flex gap-2">

                    <button type="submit" class="btn btn-primary px-4">
                        Update Staff
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Property</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>



<div class="container py-5">

    <div class="card shadow-sm">

        <!-- HEADER -->
        <div class="card-header bg-white">
            <h4 class="mb-0">Add New Property</h4>
        </div>

        <div class="card-body">

            <form method="POST" action="{{ route('properties.store') }}">
                @csrf

                <!-- PROPERTY INFO -->
                <h6 class="text-muted mb-3">Property Information</h6>

                <div class="row g-3">

                    <div class="col-md-6">
                        <input type="text" name="StreetName" class="form-control" placeholder="Street Name" required>
                    </div>

                    <div class="col-md-6">
                        <input type="text" name="District" class="form-control" placeholder="District">
                    </div>

                    <div class="col-md-6">
                        <input type="text" name="City" class="form-control" placeholder="City" required>
                    </div>

                    <div class="col-md-6">
                        <input type="text" name="PostalCode" class="form-control" placeholder="Postal Code">
                    </div>

                </div>

                <hr>

                <!-- DETAILS -->
                <h6 class="text-muted mb-3">Property Details</h6>

                <div class="row g-3">

                    <div class="col-md-4">
                        <input type="number" name="Rooms" class="form-control" placeholder="Rooms" required>
                    </div>

                    <div class="col-md-4">
                        <input type="number" name="RentAmount" class="form-control" placeholder="Rent Amount" required>
                    </div>

                    <div class="col-md-4">
                        <select name="PropertyTypeID" class="form-select" required>
                            <option value="">Property Type</option>
                            @foreach($types as $t)
                                <option value="{{ $t->PropertyTypeID }}">
                                    {{ $t->TypeName }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <hr>

                <!-- ASSIGNMENT -->
                <h6 class="text-muted mb-3">Assignment</h6>

                <div class="row g-3">

                    <div class="col-md-6">
                        <select name="StaffID" class="form-select" required>
                            <option value="">Assign Staff</option>
                            @foreach($staff as $s)
                                <option value="{{ $s->StaffID }}">
                                    {{ $s->FirstName }} {{ $s->LastName }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <select name="Status" class="form-select">
                            <option value="Available">Available</option>
                            <option value="Rented">Rented</option>
                            <option value="Withdrawn">Withdrawn</option>
                        </select>
                    </div>

                </div>

                <!-- BUTTONS -->
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4">
                        Save Property
                    </button>

                    <a href="{{ route('properties.index') }}" class="btn btn-secondary px-4">
                        Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

</body>
</html>
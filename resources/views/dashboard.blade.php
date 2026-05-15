<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DreamHome Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS (dashboard-card + custom-card styles) -->
    <style>
        body {
            background-color: #f5f7fb;
            font-family: Arial, sans-serif;
        }

        .navbar {
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            border-radius: 8px;
            padding: 0.5rem 1rem;
            background-color: #ffffff;
        }

        .navbar .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: #007bff;
        }

        .navbar .nav-link {
            font-weight: 500;
            color: #333333;
        }

        .navbar .nav-link:hover {
            color: #007bff;
            background-color: rgba(0, 123, 255, 0.1);
            border-radius: 5px;
        }

        .dashboard-card {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .dashboard-card h3 {
            font-size: 2rem;
            margin-bottom: 5px;
            color: #007bff;
        }

        .dashboard-card p {
            font-size: 1rem;
            color: #6c757d;
        }

        .dashboard-card:hover {
            background-color: #e2e6ea;
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }

        .custom-card {
            max-width: 100%;
            margin: 20px 0;
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            background: #fff;
            overflow: hidden;
        }

        .custom-card-header {
            background: linear-gradient(90deg, #0d6efd, #3b82f6);
            color: white;
            padding: 18px 22px;
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">DreamHome</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('branches') }}">Branches</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('staff') }}">Staff</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('properties') }}">Properties</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('renters') }}">Renters</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('leases') }}">Leases</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('inspections') }}">Inspections</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Dashboard Cards -->
<div class="container">
    <div class="row g-4 mb-4">
        <div class="col-md-2 col-sm-6">
            <div class="dashboard-card" onclick="location.href='{{ route('branches.index') }}'">
                <h3>{{ $counts['branches'] }}</h3>
                <p>Branches</p>
            </div>
        </div>
        <div class="col-md-2 col-sm-6">
            <div class="dashboard-card" onclick="location.href='{{ route('staff.index') }}'">
                <h3>{{ $counts['staff'] }}</h3>
                <p>Staff</p>
            </div>
        </div>
        <div class="col-md-2 col-sm-6">
            <div class="dashboard-card" onclick="location.href='{{ route('properties.index') }}'">
                <h3>{{ $counts['properties'] }}</h3>
                <p>Properties</p>
            </div>
        </div>
        <div class="col-md-2 col-sm-6">
            <div class="dashboard-card" onclick="location.href='{{ route('renters.index') }}'">
                <h3>{{ $counts['renters'] }}</h3>
                <p>Renters</p>
            </div>
        </div>
        <div class="col-md-2 col-sm-6">
            <div class="dashboard-card" onclick="location.href='{{ route('leases.index') }}'">
                <h3>{{ $counts['leases'] }}</h3>
                <p>Active Leases</p>
            </div>
        </div>
        <div class="col-md-2 col-sm-6">
            <div class="dashboard-card" onclick="location.href='{{ route('inspections.index') }}'">
                <h3>{{ $counts['inspections'] }}</h3>
                <p>Inspections</p>
            </div>
        </div>
    </div>

    <!-- System Overview -->
    <div class="custom-card">
        <div class="custom-card-header">System Overview</div>
        <div class="p-4">
            <p>Welcome to DreamHome Professional Admin System. Manage your properties, renters, leases, inspections, branches, and staff here.</p>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row text-center g-2">
        <div class="col-md-2 col-sm-6"><a href="{{ route('properties.create') }}" class="btn btn-outline-primary w-100">Add Property</a></div>
        <div class="col-md-2 col-sm-6"><a href="{{ route('staff.create') }}" class="btn btn-outline-primary w-100">Add Staff</a></div>
        <div class="col-md-2 col-sm-6"><a href="{{ route('renters.create') }}" class="btn btn-outline-primary w-100">Add Renter</a></div>
        <div class="col-md-2 col-sm-6"><a href="{{ route('leases.create') }}" class="btn btn-outline-success w-100">New Lease</a></div>
        <div class="col-md-2 col-sm-6"><a href="{{ route('inspections.create') }}" class="btn btn-outline-info w-100">Record Inspection</a></div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
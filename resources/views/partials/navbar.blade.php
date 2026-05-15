<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container">
        <!-- Brand -->
        <a class="navbar-brand" href="{{ route('dashboard') }}">DreamHome</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <!-- Home link routes to dashboard -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">Home</a>
                </li>
                
                <!-- Other links -->
                <li class="nav-item"><a class="nav-link" href="{{ route('branches.index') }}">Branches</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('staff.index') }}">Staff</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('properties.index') }}">Properties</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('renters.index') }}">Renters</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('leases.index') }}">Leases</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('inspections.index') }}">Inspections</a></li>
            </ul>
        </div>
    </div>
</nav>
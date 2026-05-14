<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">DreamHome</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('branches') ? 'active' : '' }}" href="{{ url('branches') }}">Branches</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('staff') ? 'active' : '' }}" href="{{ url('staff') }}">Staff</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('properties') ? 'active' : '' }}" href="{{ url('properties') }}">Properties</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('renters') ? 'active' : '' }}" href="{{ url('renters') }}">Renters</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('leases') ? 'active' : '' }}" href="{{ url('leases') }}">Leases</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('inspections') ? 'active' : '' }}" href="{{ url('inspections') }}">Inspections</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
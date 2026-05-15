<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inspection Management</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

@include('partials.navbar')

<div class="container">

    <div class="card shadow-sm branch-card">

        {{-- HEADER --}}
        <div class="card-header bg-white d-flex justify-content-between align-items-center branch-header">

            <h3 class="mb-0 fw-semibold">Property Inspections</h3>

            <a href="{{ url('inspections/create') }}"
               class="btn btn-primary px-4 branch-btn">
                + Add Inspection
            </a>

        </div>

        {{-- TABLE --}}
        <div class="card-body p-3">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">

                <table class="table table-hover table-striped align-middle branch-table">

                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Property</th>
                            <th>Address</th>
                            <th>Date</th>
                            <th>Inspector</th>
                            <th>Notes</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($inspections as $inspection)

                        <tr>
                            <td>{{ $inspection->InspectionID }}</td>

                            <td>
                                {{ $inspection->property->StreetName ?? 'N/A' }}
                            </td>

                            <td>
                                {{ $inspection->property->City ?? 'N/A' }}
                            </td>

                            <td>{{ $inspection->InspectDate }}</td>

                            <td>
                                {{ $inspection->staff->FirstName ?? '' }}
                                {{ $inspection->staff->LastName ?? '' }}
                            </td>

                            <td>
                                {{ \Illuminate\Support\Str::limit($inspection->Notes, 50) }}
                            </td>

                            <td class="d-flex gap-1">

                                <a href="{{ url('inspections/'.$inspection->InspectionID) }}"
                                   class="btn btn-info btn-sm">
                                    View
                                </a>

                                <a href="{{ url('inspections/'.$inspection->InspectionID.'/edit') }}"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ url('inspections/'.$inspection->InspectionID) }}"
                                      method="POST"
                                      onsubmit="return confirm('Delete this inspection?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm">
                                        Delete
                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                No inspections found
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

</body>
</html>
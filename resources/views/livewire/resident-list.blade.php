<div class="container-fluid py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 fw-bold mb-0">Residents</h1>

        @can('official')
        <a href="{{ route('admin.residents.create') }}"
           class="btn btn-primary shadow-sm">
           + Add Resident
        </a>
        @endcan
    </div>

    <!-- Table Card -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th class="text-center">Gender</th>
                            <th class="text-center">Age</th>
                            <th class="text-center">Blood Type</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($residents as $resident)
                        <tr>
                            <td class="fw-medium">{{ $resident->full_name }}</td>
                            <td class="text-center">{{ ucfirst($resident->gender) }}</td>
                            <td class="text-center">{{ $resident->age }}</td>
                            <td class="text-center">{{ $resident->blood_type }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.residents.health-records', $resident->id) }}"
                                   class="btn btn-sm btn-success me-1">
                                   Records
                                </a>
                                @can('official')
                                <a href="{{ route('admin.residents.edit', $resident->id) }}"
                                   class="btn btn-sm btn-primary">
                                   Edit
                                </a>
                                @endcan
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted p-4">
                                No residents found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

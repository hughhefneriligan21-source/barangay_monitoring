<div class="container-fluid py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 fw-bold mb-0">Health Records</h1>
        <a href="{{ route('admin.health-records.create') }}"
           class="btn btn-primary shadow-sm">
            Add Record
        </a>
    </div>

    <!-- Table Card -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Resident</th>
                            <th>Diagnosis</th>
                            <th>Recorded By</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($records as $record)
                        <tr>
                            <td>{{ $record->record_date }}</td>
                            <td>{{ $record->resident->full_name }}</td>
                            <td>{{ Str::limit($record->diagnosis, 40) }}</td>
                            <td>{{ $record->recordedBy->name }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.health-records.edit', $record->id) }}"
                                   class="btn btn-sm btn-outline-primary me-1">
                                   Edit
                                </a>
                                <button wire:click="delete({{ $record->id }})"
                                        class="btn btn-sm btn-outline-danger">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted p-4">
                                No health records found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

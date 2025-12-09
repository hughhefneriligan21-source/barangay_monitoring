<div class="container-fluid py-4">

    <h1 class="mb-4 fw-bold text-dark">Dashboard Overview</h1>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        @foreach([
            ['Total Residents',$totalResidents,'primary'],
            ['Health Records',$totalHealthRecords,'success'],
            ['Male',$maleCount,'info'],
            ['Female',$femaleCount,'danger']
        ] as [$label,$value,$color])
        <div class="col-12 col-md-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <p class="text-muted mb-1">{{ $label }}</p>
                    <h3 class="fw-bold text-{{ $color }}">{{ $value }}</h3>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Charts -->
    <div class="row g-3 mb-4">

        <!-- Age Distribution -->
        <div class="col-12 col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h6 class="mb-0 fw-bold">Age Distribution</h6>
                </div>
                <div class="card-body">
                    @foreach($ageGroups as $group)
                    <div class="mb-3">
                        <div class="d-flex justify-content-between small">
                            <span>{{ $group->age_group }}</span>
                            <span>{{ $group->count }}</span>
                        </div>
                        <div class="progress" style="height:6px;">
                            <div class="progress-bar bg-primary" role="progressbar"
                                 style="width: {{ ($group->count / max(1,$totalResidents)) * 100 }}%">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Blood Type Distribution -->
        <div class="col-12 col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h6 class="mb-0 fw-bold">Blood Type Distribution</h6>
                </div>
                <div class="card-body">
                    @forelse($bloodTypes as $blood)
                    <div class="mb-3">
                        <div class="d-flex justify-content-between small">
                            <span>{{ $blood->blood_type }}</span>
                            <span>{{ $blood->count }}</span>
                        </div>
                        <div class="progress" style="height:6px;">
                            <div class="progress-bar bg-danger" role="progressbar"
                                 style="width: {{ ($blood->count / max(1,$totalResidents)) * 100 }}%">
                            </div>
                        </div>
                    </div>
                    @empty
                        <p class="text-muted small">No data</p>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

    <!-- Recent Health Records -->
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0 fw-bold">Recent Health Records</h6>
            <a href="{{ route('admin.health-records.index') }}" class="small text-primary">View All</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Resident</th>
                            <th>Diagnosis</th>
                            <th>Recorded By</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentRecords as $record)
                        <tr>
                            <td>{{ $record->record_date->format('M d, Y') }}</td>
                            <td>{{ $record->resident->full_name }}</td>
                            <td>{{ Str::limit($record->diagnosis, 40) }}</td>
                            <td>{{ $record->recordedBy->name }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No records</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

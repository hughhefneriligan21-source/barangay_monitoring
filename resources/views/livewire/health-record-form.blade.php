<div class="container-fluid py-4">

    <div class="row justify-content-center">
        <div class="col-12">

            <div class="card shadow-sm rounded-3">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Add Health Record</h5>
                </div>

                <div class="card-body">
                    <form wire:submit.prevent="save">

                        {{-- Resident Selection --}}
                        <div class="mb-3">
                            <label class="form-label">Resident</label>
                            <select wire:model="residentId" class="form-select">
                                <option value="">Select Resident</option>
                                @foreach($residents as $r)
                                    <option value="{{ $r->id }}">{{ $r->full_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Basic Vitals --}}
                        <h6 class="text-secondary mb-2">Vitals</h6>
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Record Date</label>
                                <input type="date" wire:model.defer="record_date" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Temperature (°C)</label>
                                <input type="number" step="0.1" wire:model.defer="temperature" class="form-control" placeholder="Temperature">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Blood Pressure</label>
                                <input type="text" wire:model.defer="blood_pressure" class="form-control" placeholder="Blood Pressure">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Weight (kg)</label>
                                <input type="text" wire:model.defer="weight" class="form-control" placeholder="Weight">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Height (cm)</label>
                                <input type="text" wire:model.defer="height" class="form-control" placeholder="Height">
                            </div>
                        </div>

                        {{-- Symptoms / Diagnosis / Medications / Notes --}}
                        <div class="mb-3">
                            <label class="form-label">Symptoms</label>
                            <textarea wire:model.defer="symptoms" class="form-control" rows="2" placeholder="Symptoms"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Diagnosis</label>
                            <textarea wire:model.defer="diagnosis" class="form-control" rows="2" placeholder="Diagnosis"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Medications</label>
                            <textarea wire:model.defer="medications" class="form-control" rows="2" placeholder="Medications"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Notes</label>
                            <textarea wire:model.defer="notes" class="form-control" rows="2" placeholder="Notes"></textarea>
                        </div>

                        {{-- Actions --}}
                        <div class="d-flex justify-content-end gap-2 mt-3">
                            <a href="{{ route('admin.health-records.index') }}" class="btn btn-secondary">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Save
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>

</div>

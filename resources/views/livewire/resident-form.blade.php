<div class="container-fluid py-4">

    <div class="row justify-content-center">
        <div class="col-12">

            <div class="card shadow-sm rounded-3">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">{{ $isEdit ? 'Edit Resident' : 'Add Resident' }}</h5>
                </div>

                <div class="card-body">
                    <form wire:submit.prevent="save">

                        {{-- Basic Information --}}
                        <h6 class="text-secondary mb-3">Basic Information</h6>
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label">First Name</label>
                                <input type="text" wire:model.defer="resident.first_name" class="form-control">
                                @error('resident.first_name') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Last Name</label>
                                <input type="text" wire:model.defer="resident.last_name" class="form-control">
                                @error('resident.last_name') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Gender</label>
                                <select wire:model.defer="resident.gender" class="form-select">
                                    <option value="">Select</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                @error('resident.gender') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        {{-- Other Details --}}
                        <h6 class="text-secondary mb-3">Other Details</h6>
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Birth Date</label>
                                <input type="date" wire:model.defer="resident.birth_date" class="form-control">
                                @error('resident.birth_date') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Blood Type</label>
                                <select wire:model.defer="resident.blood_type" class="form-select">
                                    <option value="">Select</option>
                                    <option>A</option>
                                    <option>B</option>
                                    <option>AB</option>
                                    <option>O</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Contact Number</label>
                                <input type="text" wire:model.defer="resident.contact_number" class="form-control">
                            </div>
                        </div>

                        {{-- Address --}}
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea wire:model.defer="resident.address" class="form-control" rows="2"></textarea>
                        </div>

                        {{-- Actions --}}
                        <div class="d-flex justify-content-end gap-2 mt-3">
                            <a href="{{ route('admin.residents.index') }}" class="btn btn-secondary">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                {{ $isEdit ? 'Update' : 'Save' }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>

</div>

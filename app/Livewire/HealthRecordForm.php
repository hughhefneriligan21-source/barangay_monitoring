<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\HealthRecord;
use App\Models\Resident;

class HealthRecordForm extends Component
{
    public $residentId;
    public $record_date;
    public $temperature;
    public $blood_pressure;
    public $weight;
    public $height;
    public $symptoms;
    public $diagnosis;
    public $medications;
    public $notes;

    public $residents = [];

    protected $rules = [
        'residentId' => 'required|exists:residents,id',
        'record_date' => 'required|date',
        'temperature' => 'nullable|numeric',
        'blood_pressure' => 'nullable|string|max:20',
        'weight' => 'nullable|numeric',
        'height' => 'nullable|numeric',
        'symptoms' => 'nullable|string',
        'diagnosis' => 'nullable|string',
        'medications' => 'nullable|string',
        'notes' => 'nullable|string',
    ];

    public function mount($residentId = null)
    {
        $this->residentId = $residentId;
        $this->record_date = now()->format('Y-m-d');
        $this->residents = Resident::orderBy('last_name')->get();
    }

    public function save()
    {
        $this->validate();

        HealthRecord::create([
            'resident_id' => $this->residentId,
            'record_date' => $this->record_date,
            'temperature' => $this->temperature,
            'blood_pressure' => $this->blood_pressure,
            'weight' => $this->weight,
            'height' => $this->height,
            'symptoms' => $this->symptoms,
            'diagnosis' => $this->diagnosis,
            'medications' => $this->medications,
            'notes' => $this->notes,
            'recorded_by' => auth()->id(),
        ]);

        session()->flash('message', 'Health record created successfully.');

        return redirect()->route('admin.residents.health-records', $this->residentId);
    }

    public function render()
    {
        return view('livewire.health-record-form');
    }
}
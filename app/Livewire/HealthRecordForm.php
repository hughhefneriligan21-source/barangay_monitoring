<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\HealthRecord;
use App\Models\Resident;

class HealthRecordForm extends Component
{

    public HealthRecord $record;

    public $record_date;
    public $residents;
    public function rules()
    {
        return [
            'record.resident_id' => 'required|exists:residents,id',
            'record_date' => 'required|date',
            'record.temperature' => 'nullable|numeric',
            'record.blood_pressure' => 'nullable|string|max:20',
            'record.weight' => 'nullable|numeric',
            'record.height' => 'nullable|numeric',
            'record.symptoms' => 'nullable|string',
            'record.diagnosis' => 'nullable|string',
            'record.medications' => 'nullable|string',
            'record.notes' => 'nullable|string',
        ];
    }
    public function mount()
    {
        $this->record = new HealthRecord();
        $this->record_date = now()->format('Y-m-d');
        $this->residents = Resident::orderBy('last_name')->get();
    }

    public function save()
    {

        try {
            $this->validate();

            $this->record->record_date =   $this->record_date;

            $this->record->recorded_by = auth()->id();

            $this->record->save();

            $this->dispatch('done', success: "Nice One");

            return redirect()->route(
                'admin.health-records.index'
            );
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something went wrong: ");
        }
    }

    public function render()
    {
        return view('livewire.health-record-form');
    }
}

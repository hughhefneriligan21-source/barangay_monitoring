<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Resident;

class ResidentFormEdit extends Component
{
    public Resident $resident;

    public bool $isEdit = false;

    public function rules()
    {
        return [
            'resident.first_name' => 'required',
            'resident.last_name' => 'required',
            'resident.gender' => 'required',
            'resident.birth_date' => 'required',
            'resident.address' => 'nullable',
            'resident.blood_type' => 'nullable',
            'resident.contact_number' => 'nullable',
        ];
    }


    public function mount($id)
    {
        $this->isEdit=true;
        $this->resident = Resident::findOrFail($id);
    }

    public function save()
    {
        $this->validate();
        try {
            
            $this->resident->update();

            $this->dispatch('done', success: "Nice One. Updated");

            return redirect()->route('admin.residents.index');
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something went wrong: ");
        }
    }
    public function render()
    {
        $residents = Resident::all();
        return view(
            'livewire.resident-form',
            ["residents" => $residents]
        );
    }
}

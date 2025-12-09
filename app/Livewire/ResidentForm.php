<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Resident;

class ResidentForm extends Component
{
    public Resident $resident;
   public bool $isEdit = false;

public function rules(){
    return [
        'resident.first_name' => 'required',
        'resident.last_name' => 'required',
        'resident.gender' => 'required',
        'resident.birth_date' => 'required',
    ];
}

public function mount($residentId = null)
{
    if ($residentId) {
        $this->isEdit = true;
        $resident = Resident::findOrFail($residentId);
        $this->fill($resident->toArray());
    }
}

public function save()
{
    $this->validate();

    $this->resident->save();

    return redirect()->route('admin.residents.index');
}
    public function render()
    {
        $residents=Resident::all();
        return view('livewire.resident-form',
    ["residents"=>$residents]);
    }
}
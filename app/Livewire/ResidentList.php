<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Resident;

class ResidentList extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function deleteResident($id)
    {
        if (auth()->user()->isOfficial()) {
            Resident::find($id)->delete();
            $this->dispatch('done', success: "bye bye" );
        }
    }

    public function render()
    {
        $residents = Resident::where('first_name', 'like', '%'.$this->search.'%')
            ->orWhere('last_name', 'like', '%'.$this->search.'%')
            ->orderBy('last_name')
            ->paginate(10);

        return view('livewire.resident-list', compact('residents'));
    }
}
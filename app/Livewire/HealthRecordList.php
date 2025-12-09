<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\HealthRecord;
use App\Models\Resident;

class HealthRecordList extends Component
{
    use WithPagination;

    public $residentId = null;
    public $search = '';
    public $filterDate = '';

    public function mount($residentId = null)
    {
        $this->residentId = $residentId;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterDate()
    {
        $this->resetPage();
    }

    public function deleteRecord($id)
    {
        if (auth()->user()->isOfficial()) {
            HealthRecord::find($id)->delete();
            session()->flash('message', 'Health record deleted successfully.');
        }
    }

    public function render()
    {
        $query = HealthRecord::with(['resident', 'recordedBy']);

        if ($this->residentId) {
            $query->where('resident_id', $this->residentId);
            $resident = Resident::find($this->residentId);
        } else {
            $resident = null;
        }

        if ($this->search) {
            $query->whereHas('resident', function($q) {
                $q->where('first_name', 'like', '%'.$this->search.'%')
                  ->orWhere('last_name', 'like', '%'.$this->search.'%');
            });
        }

        if ($this->filterDate) {
            $query->whereDate('record_date', $this->filterDate);
        }

        $records = $query->latest('record_date')->paginate(10);

        return view('livewire.health-record-list', [
            'records' => $records,
            'resident' => $resident,
        ]);
    }
}
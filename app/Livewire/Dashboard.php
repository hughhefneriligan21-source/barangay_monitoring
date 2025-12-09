<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Resident;
use App\Models\HealthRecord;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public function render()
    {
        $totalResidents = Resident::count();
        $totalHealthRecords = HealthRecord::count();
        $maleCount = Resident::where('gender', 'male')->count();
        $femaleCount = Resident::where('gender', 'female')->count();
        
        // Recent health records
        $recentRecords = HealthRecord::with(['resident', 'recordedBy'])
            ->latest()
            ->take(5)
            ->get();
        
        // Age distribution
        $ageGroups = Resident::select(
            DB::raw('CASE 
                WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) < 18 THEN "0-17"
                WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 18 AND 35 THEN "18-35"
                WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 36 AND 60 THEN "36-60"
                ELSE "60+" 
            END as age_group'),
            DB::raw('count(*) as count')
        )
        ->groupBy('age_group')
        ->get();

        // Blood type distribution
        $bloodTypes = Resident::select('blood_type', DB::raw('count(*) as count'))
            ->whereNotNull('blood_type')
            ->groupBy('blood_type')
            ->get();

        return view('livewire.dashboard', [
            'totalResidents' => $totalResidents,
            'totalHealthRecords' => $totalHealthRecords,
            'maleCount' => $maleCount,
            'femaleCount' => $femaleCount,
            'recentRecords' => $recentRecords,
            'ageGroups' => $ageGroups,
            'bloodTypes' => $bloodTypes,
        ]);
    }
}
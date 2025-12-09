<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HealthRecord extends Model
{
    protected $fillable = [
        'resident_id',
        'record_date',
        'temperature',
        'blood_pressure',
        'weight',
        'height',
        'symptoms',
        'diagnosis',
        'medications',
        'notes',
        'recorded_by',
    ];

    protected $casts = [
        'record_date' => 'date',
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }

    public function recordedBy()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}
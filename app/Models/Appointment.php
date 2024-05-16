<?php

namespace App\Models;

use App\Enum\AppointmentStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'clinic_id',
        'schedule',
        'status',
        'complaint',
    ];

    protected $casts = [
        'schedule' => 'datetime',
        'status' => AppointmentStatusEnum::class,
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}

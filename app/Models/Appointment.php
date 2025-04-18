<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Traits\QueryForAppointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Schedule;

class Appointment extends Model
{
    use QueryForAppointment;

    // Status constants
    public const STATUS_PENDING = 'pending';
    public const STATUS_CONFIRMED = 'confirmed';
    public const STATUS_CANCELLED = 'cancelled';

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'schedule_id',
        'appointment_date',
        'status',
        'notes'
    ];

    public function doctor(): BelongsTo {
        return $this->belongsTo(Doctor::class);
    }

    public function patient(): BelongsTo {
        return $this->belongsTo(Patient::class);
    }

    public function schedule(): BelongsTo {
        return $this->belongsTo(Schedule::class);
    }
}

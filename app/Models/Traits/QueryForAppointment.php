<?php

namespace App\Models\Traits;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\Scope;
use App\Models\User;

trait QueryForAppointment
{
    #[Scope]
    protected function forAdmin(Builder $query): void{
        $query->with(['doctor.user', 'patient.user', 'schedule']);
    }

    #[Scope]
    protected function forPatient(Builder $query, User $user): void{
        $query->with(['doctor.user', 'schedule'])
        ->where('patient_id', $user->patient->id);
    }

    #[Scope]
    protected function forDoctor(Builder $query, User $user): void{
        $query->with(['patient.user', 'schedule'])
        ->where('patient_id', $user->patient->id);
    }
}

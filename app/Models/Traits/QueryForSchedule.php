<?php

namespace App\Models\Traits;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\Scope;
use App\Models\User;

trait QueryForSchedule
{
    // #[Scope]
    // protected function forAdmin(Builder $query): void{
    //     $query->with(['doctor.user', 'patient.user']);
    // }

    // #[Scope]
    // protected function forPatient(Builder $query, User $user): void{
    //     $query->with('doctor.user')
    //     ->where('patient_id', $user->patient->id);
    // }

    // #[Scope]
    // protected function forDoctor(Builder $query, User $user): void{
    //     $query->where('doctor_id', $user->doctor->id);
    // }
}

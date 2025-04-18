<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Resources\AppointmentResource;
use App\Models\User;
use App\Http\Requests\AppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user()->load('patient', 'doctor');

        $appointments = match ($user->role) {
            'patient' => Appointment::forPatient($user)->get(),
            'doctor' => Appointment::forDoctor($user)->get(),
            default => Appointment::forAdmin()->get(),
        };

        return AppointmentResource::collection($appointments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AppointmentRequest $request)
    {
        Gate::authorize('update', $appointment);

        $validated = $request->safe();
        
        $appointment = Appointment::create([
            'patient_id' => $request->user()->patient->id,
            'doctor_id' => $validated["doctor_id"],
            'schedule_id' => $validated["schedule_id"],
            'appointment_date' => $validated["appointment_date"],
            'notes' => $validated["notes"],
            'status' => Appointment::STATUS_PENDING,
        ])->load(['doctor.user', 'patient.user']);

        return response()->json([
            'message' => 'Appointment created successfully',
            'data' => $appointment->toResource(),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        Gate::authorize('view', $appointment);
        return $appointment->load(['doctor.user', 'patient.user', 'schedule'])->toResource();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        Gate::authorize('update', $appointment);

        $validated = $request->safe();

        $appointment->status = $request["status"];
        $appointment->save();

        return response()->json([
            'message' => 'Appointment updated successfully',
            'data' => new $appointment->load(['doctor.user', 'patient.user', 'schedule'])->toResource(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        Gate::authorize('delete', $appointment);
        $appointment->delete();
    }
}

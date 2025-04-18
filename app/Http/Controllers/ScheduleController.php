<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Requests\ScheduleRequest;
use Illuminate\Support\Facades\Gate;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the schedule.
     */
    public function index()
    {
        Gate::authorize('viewAny', Schedule::class);

        if (auth()->user()->role === 'admin') {
            return Schedule::with('doctor.user')->get()
            ->toResourceCollection();
        }

        return Schedule::with('doctor.user')
            ->where('doctor_id', auth()->user()->doctor->id)
            ->get()
            ->toResourceCollection();
    }

    /**
     * Create a schedule.
     */
    public function store(ScheduleRequest $request)
    {
        $validated = $request->validated();

        $schedule = Schedule::create([
            'doctor_id' => $validated['doctor_id'],
            'day' => $validated['day'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
        ]);
        return response()->json([
            'message' => 'Schedule created successfully',
            'schedule' => $schedule->toResource(),
        ], 201);
    }

    /**
     * Display the specified schedule.
     */
    public function show(Schedule $schedule)
    {
        Gate::authorize('view', $schedule);
        return $schedule->load('doctor.user')->toResource();
    }

    /**
     * Update the specified schedule.
     */
    public function update(ScheduleRequest $request, Schedule $schedule)
    {
        Gate::authorize('update', $schedule);

        $validated = $request->validated();

        $schedule->update([
            'doctor_id' => $validated['doctor_id'],
            'day' => $validated['day'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
        ]);

        return response()->json([
            'message' => 'Schedule updated successfully',
            'schedule' => $schedule->load('doctor.user')->toResource(),
        ]);
    }

    /**
     * Remove the specified schedule.
     */
    public function destroy(Schedule $schedule)
    {
        Gate::authorize('delete', $schedule);

        $schedule->delete();

        return response()->json([
            'message' => 'Schedule deleted successfully',
        ]);
    }
}

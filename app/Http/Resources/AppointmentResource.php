<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ScheduleResource;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'notes' => $this->notes,
            'appointment_date' => $this->appointment_date,
            'status' => $this->status,
            'patient' => $this->whenLoaded('patient'),
            'doctor' => $this->whenLoaded('doctor'),
            'schedule' => new ScheduleResource($this->whenLoaded('schedule')),
        ];
    }
}
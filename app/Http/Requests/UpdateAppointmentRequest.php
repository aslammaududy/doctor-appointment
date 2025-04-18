<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppointmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = $this->user();
        $appointment = $this->route('appointment'); // Get the appointment being updated

        // Default rules
        $rules = [
            'status' => 'required|in:pending,confirmed,canceled',
        ];

        // Admin can change to any status
        if ($user->role === 'admin') {
            return $rules;
        }

        // Doctor-specific rules
        if ($user->role === 'doctor') {
            if ($appointment->status === 'canceled') {
                // Doctor cannot change status if it's already canceled
                $rules = [
                    'status' => 'prohibited',
                ];
            }

            // Doctor can only change to confirmed or canceled
            $rules = [
                'status' => 'required|string|in:confirmed,canceled',
            ];
        }

        // Patient-specific rules
        if ($user->role === 'patient') {
            if ($appointment->status === 'canceled') {
                // Patient cannot change status if it's already canceled
                $rules= [
                    'status' => 'prohibited',
                ];
            }

            // Patient can only change to canceled
            $rules = [
                'status' => 'required|string|in:canceled',
            ];
        }

        return $rules;
    }

    /**
     * Custom messages for validation errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        $user = $this->user();

        $messages= [
            'status.required' => 'The status field is required.',
            'status.in' => 'The status must be one of the following: pending, confirmed, or canceled.',
            'status.prohibited' => 'You are not allowed to change the status of this appointment.',
        ];

        if ($user->role === 'admin') {
            return $messages;
        }
        if($user->role === 'doctor') {
            $messages['status.in'] = 'You can only change the status to confirmed or canceled.';
        }
        if($user->role === 'patient') {
            $messages['status.in'] = 'You can only change the status to canceled.';
        }

        return $messages;
    }
}

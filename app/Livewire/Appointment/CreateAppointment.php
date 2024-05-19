<?php

namespace App\Livewire\Appointment;

use App\Enum\AppointmentStatusEnum;
use App\Models\Appointment;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CreateAppointment extends Component
{
    public string $patient_id;

    public string $clinic_id;

    public string $schedule;

    public string $complaint;

    public string $status;

    public function rules(): array
    {
        return [
            'patient_id' => ['required', 'string', Rule::exists('patients', 'id')],
            'clinic_id' => ['required', 'string', Rule::exists('clinics', 'id')],
            'schedule' => ['required', 'date'],
            'complaint' => ['required', 'string', 'max:255'],
            'status' => ['required', Rule::enum(AppointmentStatusEnum::class)],
        ];
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $this->authorize('create', Appointment::class);
        $appointmentStatuses = array_filter(AppointmentStatusEnum::cases(), function ($appointmentCase) {
            return $appointmentCase->value !== AppointmentStatusEnum::Paid->value;
        });

        $appointmentStatuses = array_map(function ($appointmentCase) {
            return [
                'value' => $appointmentCase->value,
                'name' => $appointmentCase->name,
            ];
        }, $appointmentStatuses);

        return view('livewire.appointment.create-appointment', compact('appointmentStatuses'));
    }

    public function store()
    {
        $this->authorize('create', Appointment::class);
        $this->validate();

        // Store the appointment
        Appointment::create([
            'patient_id' => $this->patient_id,
            'clinic_id' => $this->clinic_id,
            'schedule' => $this->schedule,
            'complaint' => $this->complaint,
            'status' => $this->status,
        ]);

        // Redirect to the appointment index page
        return $this->redirect('/appointment', true);
    }
}

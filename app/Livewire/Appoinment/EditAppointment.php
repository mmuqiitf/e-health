<?php

namespace App\Livewire\Appoinment;

use App\Enum\AppointmentStatusEnum;
use App\Models\Appointment;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

class EditAppointment extends Component
{
    public ?Appointment $appointment;

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

    public function mount(string $id): void
    {
        $this->appointment = Appointment::find($id);

        $this->patient_id = $this->appointment->patient_id;
        $this->clinic_id = $this->appointment->clinic_id;
        $this->schedule = $this->appointment->schedule;
        $this->complaint = $this->appointment->complaint;
        $this->status = $this->appointment->status;
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $appointmentStatuses = array_map(function ($appointmentCase) {
            return [
                'value' => $appointmentCase->value,
                'name' => $appointmentCase->name,
            ];
        }, AppointmentStatusEnum::cases());

        return view('livewire.appoinment.edit-appointment', compact('appointmentStatuses'));
    }

    public function update()
    {
        $this->validate();

        $this->appointment->update([
            'patient_id' => $this->patient_id,
            'clinic_id' => $this->clinic_id,
            'schedule' => $this->schedule,
            'complaint' => $this->complaint,
            'status' => $this->status,
        ]);

        $this->reset();

        return $this->redirect('/appointment', navigate: true);
    }
}

<?php

namespace App\Livewire\Appointment;

use App\Enum\AppointmentStatusEnum;
use App\Enum\PaymentMethodEnum;
use App\Enum\PaymentStatusEnum;
use App\Livewire\Forms\PaymentForm;
use App\Models\Appointment;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CreatePayment extends Component
{
    public Appointment $appointment;

    public PaymentForm $form;

    public function mount(string $id)
    {
        $this->appointment = Appointment::with(['patient', 'clinic'])->find($id);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $this->authorize('payment', $this->appointment);
        $paymentMethods = array_map(function ($paymentMethod) {
            return [
                'value' => $paymentMethod->value,
                'name' => $paymentMethod->name,
            ];
        }, PaymentMethodEnum::cases());

        return view('livewire.appointment.create-payment', compact('paymentMethods'));
    }

    public function store()
    {
        $this->authorize('payment', $this->appointment);
        $this->validate();

        // check if the appointment has been paid
        if ($this->appointment->payment) {
            $this->addError('appointment', 'The appointment has been paid');

            return;
        }

        // Store the payment
        $this->appointment->payment()->create([
            'amount' => $this->form->amount,
            'method' => $this->form->method,
            'card_number' => $this->form?->card_number ?? null,
            'note' => $this->form?->note ?? null,
            'status' => PaymentStatusEnum::Success->value,
        ]);

        $this->appointment->update([
            'status' => AppointmentStatusEnum::Paid->value,
        ]);

        $this->reset();

        // Redirect to the appointment index page
        $this->redirect('/appointment', true);

    }
}

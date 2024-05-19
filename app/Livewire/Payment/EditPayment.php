<?php

namespace App\Livewire\Payment;

use App\Enum\PaymentMethodEnum;
use App\Livewire\Forms\PaymentForm;
use App\Models\Payment;
use Livewire\Attributes\Layout;
use Livewire\Component;

class EditPayment extends Component
{
    public Payment $payment;

    public PaymentForm $form;

    public function mount(string $id)
    {
        $this->payment = Payment::with(['appointment' => ['patient', 'clinic']])->find($id);

        $this->form->amount = $this->payment->amount;
        $this->form->card_number = $this->payment->card_number;
        $this->form->method = $this->payment->method;
        $this->form->note = $this->payment->note;
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $this->authorize('update', $this->payment);
        $paymentMethods = array_map(function ($paymentMethod) {
            return [
                'value' => $paymentMethod->value,
                'name' => $paymentMethod->name,
            ];
        }, PaymentMethodEnum::cases());

        return view('livewire.payment.edit-payment', compact('paymentMethods'));
    }

    public function update()
    {
        $this->authorize('update', $this->payment);
        $this->validate();

        $this->payment->update([
            'amount' => $this->form->amount,
            'card_number' => $this->form->card_number,
            'method' => $this->form->method,
            'note' => $this->form->note,
        ]);

        $this->redirect('/payment', true);
    }
}

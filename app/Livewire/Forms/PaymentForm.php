<?php

namespace App\Livewire\Forms;

use App\Enum\PaymentMethodEnum;
use Illuminate\Validation\Rule;
use Livewire\Form;

class PaymentForm extends Form
{
    public string $amount;

    public string $card_number;

    public string $method;

    public string $note;

    public function rules(): array
    {
        return [
            'method' => ['required', 'string', Rule::enum(PaymentMethodEnum::class)],
            'card_number' => [Rule::requiredIf(function () {
                return $this->method === PaymentMethodEnum::Credit->value || $this->method === PaymentMethodEnum::Debit->value;
            }), 'string'],
            'amount' => ['required', 'numeric'],
            'note' => ['nullable', 'string'],
        ];
    }
}

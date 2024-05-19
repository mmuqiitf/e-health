<?php

namespace App\Livewire\Payment;

use Livewire\Attributes\Layout;
use Livewire\Component;

class IndexPayment extends Component
{
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.payment.index-payment');
    }
}

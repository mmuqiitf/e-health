<?php

namespace App\Livewire\Payment;

use App\Models\Payment;
use Livewire\Attributes\Layout;
use Livewire\Component;

class IndexPayment extends Component
{
    #[Layout('layouts.app')]
    public function render()
    {
        $this->authorize('viewAny', Payment::class);

        return view('livewire.payment.index-payment');
    }
}

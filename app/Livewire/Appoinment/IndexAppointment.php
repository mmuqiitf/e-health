<?php

namespace App\Livewire\Appoinment;

use Livewire\Attributes\Layout;
use Livewire\Component;

class IndexAppointment extends Component
{
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.appoinment.index-appointment');
    }
}

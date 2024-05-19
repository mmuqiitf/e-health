<?php

namespace App\Livewire\Appointment;

use Livewire\Attributes\Layout;
use Livewire\Component;

class IndexAppointment extends Component
{
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.appointment.index-appointment');
    }
}

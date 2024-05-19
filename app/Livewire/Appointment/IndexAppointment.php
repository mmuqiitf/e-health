<?php

namespace App\Livewire\Appointment;

use App\Models\Appointment;
use Livewire\Attributes\Layout;
use Livewire\Component;

class IndexAppointment extends Component
{
    #[Layout('layouts.app')]
    public function render()
    {
        $this->authorize('viewAny', Appointment::class);

        return view('livewire.appointment.index-appointment');
    }
}

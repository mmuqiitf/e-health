<?php

namespace App\Livewire\Patient;

use Livewire\Attributes\Layout;
use Livewire\Component;

class IndexPatient extends Component
{
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.patient.index-patient');
    }
}

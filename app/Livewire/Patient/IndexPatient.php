<?php

namespace App\Livewire\Patient;

use Livewire\Attributes\Layout;
use Livewire\Component;
use WireUi\Traits\Actions;

class IndexPatient extends Component
{
    use Actions;

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.patient.index-patient');
    }
}

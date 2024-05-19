<?php

namespace App\Livewire\Patient;

use App\Models\Patient;
use Livewire\Attributes\Layout;
use Livewire\Component;
use WireUi\Traits\Actions;

class IndexPatient extends Component
{
    use Actions;

    #[Layout('layouts.app')]
    public function render()
    {
        $this->authorize('viewAny', Patient::class);

        return view('livewire.patient.index-patient');
    }
}

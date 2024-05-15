<?php

namespace App\Livewire\Patient;

use App\Enum\ReligionEnum;
use App\Models\Patient;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CreatePatient extends Component
{
    public string $nik;

    public string $medical_record_id;

    public string $name;

    public string $birth_place;

    public string $birthday;

    public string $gender;

    public string $address;

    public string $religion;

    public function rules(): array
    {
        return [
            'nik' => ['required', 'string', 'max:16', Rule::unique('patients', 'nik')],
            'medical_record_id' => ['required', 'string', Rule::unique('patients', 'medical_record_id')],
            'name' => ['required', 'string'],
            'birth_place' => ['required', 'string'],
            'birthday' => ['required', 'date'],
            'gender' => ['required', 'in:Male,Female'],
            'address' => ['required', 'string'],
            'religion' => ['required', Rule::enum(ReligionEnum::class)],
        ];
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $religions = array_map(function ($religionCase) {
            return $religionCase->value;
        }, ReligionEnum::cases());

        return view('livewire.patient.create-patient', ['religions' => $religions]);
    }

    public function store()
    {
        $this->validate();

        Patient::create([
            'nik' => $this->nik,
            'medical_record_id' => $this->medical_record_id,
            'name' => $this->name,
            'birth_place' => $this->birth_place,
            'birthday' => $this->birthday,
            'gender' => $this->gender,
            'address' => $this->address,
            'religion' => $this->religion,
        ]);

        $this->reset();

        return redirect()->to('/patient');
    }
}

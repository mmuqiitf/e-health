<?php

namespace App\Livewire\Patient;

use App\Enum\ReligionEnum;
use App\Models\Patient;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

class EditPatient extends Component
{
    public ?Patient $patient;

    public string $nik;

    public string $medical_record_id;

    public string $name;

    public string $birth_place;

    public string $birthday;

    public string $gender;

    public string $address;

    public string $religion;

    public string $phone;

    public string $email;

    public function rules(): array
    {
        return [
            'nik' => ['required', 'string', 'max:16', Rule::unique('patients', 'nik')->ignore($this->patient)],
            'medical_record_id' => ['required', 'string', Rule::unique('patients', 'medical_record_id')->ignore($this->patient)],
            'name' => ['required', 'string'],
            'birth_place' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'email', Rule::unique('patients', 'email')->ignore($this->patient)],
            'birthday' => ['required', 'date'],
            'gender' => ['required', 'in:Male,Female'],
            'address' => ['required', 'string'],
            'religion' => ['required', Rule::enum(ReligionEnum::class)],
        ];
    }

    public function mount(string $id): void
    {
        $this->patient = Patient::find($id);

        $this->nik = $this->patient->nik;
        $this->medical_record_id = $this->patient->medical_record_id;
        $this->name = $this->patient->name;
        $this->birth_place = $this->patient->birth_place;
        $this->birthday = $this->patient->birthday;
        $this->gender = $this->patient->gender;
        $this->address = $this->patient->address;
        $this->religion = $this->patient->religion;
        $this->phone = $this->patient->phone;
        $this->email = $this->patient->email;
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $religions = array_map(function ($religionCase) {
            return $religionCase->value;
        }, ReligionEnum::cases());

        return view('livewire.patient.edit-patient', ['religions' => $religions]);
    }

    public function update()
    {
        $this->validate();

        $this->patient->update([
            'nik' => $this->nik,
            'medical_record_id' => $this->medical_record_id,
            'name' => $this->name,
            'birth_place' => $this->birth_place,
            'birthday' => $this->birthday,
            'gender' => $this->gender,
            'address' => $this->address,
            'religion' => $this->religion,
            'phone' => $this->phone,
            'email' => $this->email,
        ]);

        $this->reset();

        return $this->redirect('/patient', navigate: true);
    }
}

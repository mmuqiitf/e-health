<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'medical_record_id' => $this->medical_record_id,
            'nik' => $this->nik,
            'birth_place' => $this->birth_place,
            'birthday' => $this->birthday,
            'gender' => $this->gender,
            'address' => $this->address,
            'religion' => $this->religion,
            'email' => $this->email,
            'phone' => $this->phone,
        ];
    }
}

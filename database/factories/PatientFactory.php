<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'medical_record_id' => $this->faker->unique()->randomNumber(8, true),
            'nik' => $this->faker->nik(),
            'birth_place' => $this->faker->city,
            'birthday' => $this->faker->date(),
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'address' => $this->faker->address,
            'religion' => $this->faker->randomElement(['Islam', 'Christian', 'Catholic', 'Hindu', 'Buddha', 'Konghucu', 'Others']),
        ];
    }
}

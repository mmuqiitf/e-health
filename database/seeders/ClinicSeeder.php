<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ClinicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clinics = [
            ['name' => 'Poli Umum'],
            ['name' => 'Poli Gigi'],
            ['name' => 'Poli Mata'],
        ];

        foreach ($clinics as $clinic) {
            \App\Models\Clinic::create($clinic);
        }
    }
}

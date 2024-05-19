<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['Admin', 'Operator', 'User'];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        Role::findByName('Operator')->givePermissionTo([
            'create_payment',
            'read_payment',
            'update_payment',
            'delete_payment',
            'create_appointment',
            'read_appointment',
            'update_appointment',
            'delete_appointment',
            'payment_appointment',
        ]);
    }
}

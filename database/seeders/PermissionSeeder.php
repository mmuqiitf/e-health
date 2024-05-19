<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Clinic;
use App\Models\Patient;
use App\Models\Payment;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // define the permissions
        $basicPermissions = ['create', 'read', 'update', 'delete'];

        // generate permissions from models
        $models = [
            Payment::class => [
                ...$basicPermissions,
            ],
            Appointment::class => [
                ...$basicPermissions,
                'payment',
            ],
            Patient::class => [
                ...$basicPermissions,
            ],
            Clinic::class => [
                ...$basicPermissions,
            ],
        ];

        foreach ($models as $model => $permissions) {
            $modelName = strtolower(class_basename($model));

            foreach ($permissions as $permission) {
                $permissionName = $permission.'_'.$modelName;

                Permission::firstOrCreate(['name' => $permissionName]);
            }
        }
    }
}

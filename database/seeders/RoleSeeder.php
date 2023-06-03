<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'admin' => [
                'view-admin-dashboard-screen',
                'view-employees-screen',
                'view-departments-screen',
                'view-profile-screen',
                'view-change-password-screen',
                'view-employee-details-screen',
                'view-register-employee-screen'

            ],
            'employee' => [
                'view-profile-screen',
                'view-change-password-screen'
            ],
        ];

        foreach ($roles as $role => $permissions) {
            $roleModel = Role::create(['name' => $role]);

            foreach ($permissions as $permission) {
                $permissionModel = Permission::where('slug', $permission)->first();
                $roleModel->permissions()->attach($permissionModel, [
                    'created_at' => now(), 'updated_at' => now()
                ]);
            }
        }
    }
}

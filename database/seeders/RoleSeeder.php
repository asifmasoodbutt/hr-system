<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            ['name' => 'admin', 'created_at' => now(), 'updated_at' => now()],
            // ['name' => 'hr_manager'],
            // ['name' => 'hr'],
            ['name' => 'employee', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}

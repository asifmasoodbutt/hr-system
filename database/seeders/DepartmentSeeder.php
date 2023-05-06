<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::insert([
            ['name' => 'Human Resources', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Finance and Accounting', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sales and Marketing', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Information Technology', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Operations and Production', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Research and Development', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Legal', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}

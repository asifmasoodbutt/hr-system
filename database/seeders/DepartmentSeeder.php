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
            ['name' => 'Human Resources'],
            ['name' => 'Finance and Accounting'],
            ['name' => 'Sales and Marketing'],
            ['name' => 'Information Technology'],
            ['name' => 'Operations and Production'],
            ['name' => 'Research and Development'],
            ['name' => 'Legal']
        ]);
    }
}

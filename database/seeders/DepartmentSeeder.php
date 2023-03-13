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
            ['name' => 'Development'],
            ['name' => 'Quality Assurance (QA)'],
            ['name' => 'DevOps'],
            ['name' => 'Project Management (PM)'],
            ['name' => 'Customer Support'],
            ['name' => 'Human Resources (HR)'],
            ['name' => 'Finance and Accounting'],
            ['name' => 'Information Technology (IT)']
        ]);
    }
}

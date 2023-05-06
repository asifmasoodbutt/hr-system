<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Section::insert([
            [
                'name' => 'Recruitment and Staffing',
                'department_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Employee Relations',
                'department_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Benefits and Compensation',
                'department_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Training and Development',
                'department_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'HR Information Systems',
                'department_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Compliance',
                'department_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Accounts Payable',
                'department_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Accounts Receivable',
                'department_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Financial Planning and Analysis',
                'department_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'General Accounting',
                'department_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Treasury',
                'department_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Tax',
                'department_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Sales',
                'department_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Marketing',
                'department_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Product Management',
                'department_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Customer Service',
                'department_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Business Development',
                'department_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Analytics',
                'department_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Network Administration',
                'department_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'System Administration',
                'department_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Technical Support',
                'department_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cybersecurity',
                'department_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Software Development',
                'department_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Data Management',
                'department_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Production',
                'department_id' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Quality Assurance',
                'department_id' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Project Management',
                'department_id' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Customer Service',
                'department_id' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Research',
                'department_id' => 6,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Design and Engineering',
                'department_id' => 6,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Process Development',
                'department_id' => 6,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Project Management',
                'department_id' => 6,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Corporate Law',
                'department_id' => 7,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Employment Law',
                'department_id' => 7,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Litigation',
                'department_id' => 7,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Intellectual Property',
                'department_id' => 7,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Contracts',
                'department_id' => 7,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}

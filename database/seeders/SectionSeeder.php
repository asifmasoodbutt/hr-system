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
                'department_id' => 1
            ],
            [
                'name' => 'Employee Relations',
                'department_id' => 1
            ],
            [
                'name' => 'Benefits and Compensation',
                'department_id' => 1
            ],
            [
                'name' => 'Training and Development',
                'department_id' => 1
            ],
            [
                'name' => 'HR Information Systems',
                'department_id' => 1
            ],
            [
                'name' => 'Compliance',
                'department_id' => 1
            ],
            [
                'name' => 'Accounts Payable',
                'department_id' => 2
            ],
            [
                'name' => 'Accounts Receivable',
                'department_id' => 2
            ],
            [
                'name' => 'Financial Planning and Analysis',
                'department_id' => 2
            ],
            [
                'name' => 'General Accounting',
                'department_id' => 2
            ],
            [
                'name' => 'Treasury',
                'department_id' => 2
            ],
            [
                'name' => 'Tax',
                'department_id' => 2
            ],
            [
                'name' => 'Sales',
                'department_id' => 3
            ],
            [
                'name' => 'Marketing',
                'department_id' => 3
            ],
            [
                'name' => 'Product Management',
                'department_id' => 3
            ],
            [
                'name' => 'Customer Service',
                'department_id' => 3
            ],
            [
                'name' => 'Business Development',
                'department_id' => 3
            ],
            [
                'name' => 'Analytics',
                'department_id' => 3
            ],
            [
                'name' => 'Network Administration',
                'department_id' => 4
            ],
            [
                'name' => 'System Administration',
                'department_id' => 4
            ],
            [
                'name' => 'Technical Support',
                'department_id' => 4
            ],
            [
                'name' => 'Cybersecurity',
                'department_id' => 4
            ],
            [
                'name' => 'Software Development',
                'department_id' => 4
            ],
            [
                'name' => 'Data Management',
                'department_id' => 4
            ],
            [
                'name' => 'Production',
                'department_id' => 5
            ],
            [
                'name' => 'Quality Assurance',
                'department_id' => 5
            ],
            [
                'name' => 'Project Management',
                'department_id' => 5
            ],
            [
                'name' => 'Customer Service',
                'department_id' => 5
            ],
            [
                'name' => 'Research',
                'department_id' => 6
            ],
            [
                'name' => 'Design and Engineering',
                'department_id' => 6
            ],
            [
                'name' => 'Process Development',
                'department_id' => 6
            ],
            [
                'name' => 'Project Management',
                'department_id' => 6
            ],
            [
                'name' => 'Corporate Law',
                'department_id' => 7
            ],
            [
                'name' => 'Employment Law',
                'department_id' => 7
            ],
            [
                'name' => 'Litigation',
                'department_id' => 7
            ],
            [
                'name' => 'Intellectual Property',
                'department_id' => 7
            ],
            [
                'name' => 'Contracts',
                'department_id' => 7
            ]
        ]);
    }
}

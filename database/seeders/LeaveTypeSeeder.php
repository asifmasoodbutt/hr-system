<?php

namespace Database\Seeders;

use App\Models\LeaveType;
use Illuminate\Database\Seeder;

class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LeaveType::insert([
            [
                'leave_type' => 'Annual Leave',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'leave_type' => 'Sick Leave',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'leave_type' => 'Maternity/Paternity Leave',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'leave_type' => 'Personal/Carer\'s Leave',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'leave_type' => 'Urgent Leave',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'leave_type' => 'Short Leave',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'leave_type' => 'Half Leave',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}

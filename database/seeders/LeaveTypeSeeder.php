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
                'leave_type' => 'Sick / Casual Leave',
                'description' => 'Any sick or casual leaves.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'leave_type' => 'Short Leave',
                'description' => 'Urgent or sick short leave.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'leave_type' => 'Annual Leave',
                'description' => 'Annual leaves assigned to employee.',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'title' => 'React Training',
                'event_type_id' => 1,
                'from_date' => '2024-01-20 00:00:00',
                'to_date' => '2024-01-25 00:00:00',
                'manager_id' => 1,
                'is_active' => 1,
            ],
            [
                'title' => 'Cricket Contest',
                'event_type_id' => 5,
                'from_date' => '2024-01-26 00:00:00',
                'to_date' => '2024-01-27 00:00:00',
                'manager_id' => 1,
                'is_active' => 1,
            ],
            [
                'title' => 'Laravel Workshop',
                'event_type_id' => 2,
                'from_date' => '2024-01-29 00:00:00',
                'to_date' => '2024-01-31 00:00:00',
                'manager_id' => 1,
                'is_active' => 1,
            ]
        ];
    }
}

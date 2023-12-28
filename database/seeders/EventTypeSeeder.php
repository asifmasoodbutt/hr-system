<?php

namespace Database\Seeders;

use App\Models\EventType;
use Illuminate\Database\Seeder;

class EventTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EventType::insert([
            ['name' => 'Training Session', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Workshop', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Informative Seminar', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Employee Recognition Ceremony', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sports Gala', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Annual Dinner', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Product Launch', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Networking Event', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Job Fair', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Webinar', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Milestone Celebration', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Product Demonstration', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Charity Event', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Award Ceremony', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Gender::insert([
            ['gender' => 'male', 'created_at' => now(), 'updated_at' => now()],
            ['gender' => 'female', 'created_at' => now(), 'updated_at' => now()],
            ['gender' => 'other', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}

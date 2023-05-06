<?php

namespace Database\Seeders;

use App\Models\DegreeLevel;
use Illuminate\Database\Seeder;

class DegreeLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DegreeLevel::insert([
            ['level' => 'Certificate/Diploma', 'created_at' => now(), 'updated_at' => now()],
            ['level' => 'Associate\'s degree', 'created_at' => now(), 'updated_at' => now()],
            ['level' => 'Bachelor\'s degree', 'created_at' => now(), 'updated_at' => now()],
            ['level' => 'Master\'s degree', 'created_at' => now(), 'updated_at' => now()],
            ['level' => 'Doctorate degree', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}

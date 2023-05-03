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
            ['level' => 'Certificate/Diploma'],
            ['level' => 'Associate\'s degree'],
            ['level' => 'Bachelor\'s degree'],
            ['level' => 'Master\'s degree'],
            ['level' => 'Doctorate degree']
        ]);
    }
}

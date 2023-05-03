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
            ['gender' => 'male'],
            ['gender' => 'female'],
            ['gender' => 'other']
        ]);
    }
}

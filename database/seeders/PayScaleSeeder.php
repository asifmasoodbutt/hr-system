<?php

namespace Database\Seeders;

use App\Models\PayScale;
use Illuminate\Database\Seeder;

class PayScaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PayScale::insert([
            [
                'level' => 'Entry-level',
                'basic_salary' => 30000,
                'allowances' => 5000,
                'benefits' => 5000,
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'level' => 'Intermediate',
                'basic_salary' => 50000,
                'allowances' => 8000,
                'benefits' => 8000,
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'level' => 'Senior',
                'basic_salary' => 80000,
                'allowances' => 15000,
                'benefits' => 15000,
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'level' => 'Senior',
                'basic_salary' => 150000,
                'allowances' => 30000,
                'benefits' => 30000,
                'created_at' => now(), 
                'updated_at' => now()
            ]
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\ContractType;
use Illuminate\Database\Seeder;

class ContractTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContractType::insert([
            ['type' => 'permanent', 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'fixed-term', 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'part-time', 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'temporary', 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'freelance', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}

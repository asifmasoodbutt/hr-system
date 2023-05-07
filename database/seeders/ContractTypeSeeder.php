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
            ['type' => 'Permanent', 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'Fixed-term', 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'Part-time', 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'Temporary', 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'Freelance', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}

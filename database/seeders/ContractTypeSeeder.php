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
            ['type' => 'permanent'],
            ['type' => 'fixed-term'],
            ['type' => 'part-time'],
            ['type' => 'temporary'],
            ['type' => 'freelance']
        ]);
    }
}

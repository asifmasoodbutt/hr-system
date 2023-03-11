<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            'first_name' => 'Asif',
            'last_name' => 'Masood',
            'gender' => 'male',
            'date_of_birth' => '1997-05-21',
            'email' => 'asif.masood@example.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'joining_date' => '2021-01-18',
            'father_name' => 'Masood Butt'
        ]);
    }
}

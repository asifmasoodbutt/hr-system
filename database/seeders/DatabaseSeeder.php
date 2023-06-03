<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Artisan::call('passport:install');
        $this->call(ContractTypeSeeder::class);
        $this->call(DegreeLevelSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(GenderSeeder::class);
        $this->call(PayScaleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RoleUserSeeder::class);
        // $this->call(LeaveTypeSeeder::class);
    }
}

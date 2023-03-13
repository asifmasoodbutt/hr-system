<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::insert([
            [
                'name' => 'Register employee',
                'slug' => 'register-employee'
            ],
            [
                'name' => 'Create department',
                'slug' => 'create-department'
            ],
            [
                'name' => 'View personal data',
                'slug' => 'view-personal-data'
            ],
            [
                'name' => 'Update non-sensitive personal details',
                'slug' => 'update-non-sensitive-personal-details'
            ],
            [
                'name' => 'Create post',
                'slug' => 'create-post'
            ],
            [
                'name' => 'View post',
                'slug' => 'view-post'
            ],
            [
                'name' => 'Delete post',
                'slug' => 'delete-post'
            ],
            [
                'name' => 'Update post',
                'slug' => 'update-post'
            ],
            [
                'name' => 'Create comment',
                'slug' => 'create-comment'
            ],
            [
                'name' => 'Update comment',
                'slug' => 'update-comment'
            ],
            [
                'name' => 'View comment',
                'slug' => 'view-comment'
            ],
            [
                'name' => 'Delete comment',
                'slug' => 'delete-comment'
            ],
            [
                'name' => 'Apply for leave',
                'slug' => 'apply-for-leave'
            ],
            [
                'name' => 'View attendance',
                'slug' => 'view-attendance'
            ],
            [
                'name' => 'Update attendance',
                'slug' => 'update-attendance'
            ],
            [
                'name' => 'View payslip',
                'slug' => 'view-payslip'
            ],
            [
                'name' => 'Apply for perks',
                'slug' => 'apply-for-perks'
            ],
            [
                'name' => 'Create job',
                'slug' => 'create-job'
            ],
            [
                'name' => 'Create event',
                'slug' => 'create-event'
            ],
            [
                'name' => 'View event',
                'slug' => 'view-event'
            ],
            [
                'name' => 'Update event',
                'slug' => 'update-event'
            ],
            [
                'name' => 'Delete event',
                'slug' => 'create-event'
            ],
            [
                'name' => 'Create project',
                'slug' => 'create-project'
            ],
            [
                'name' => 'View project',
                'slug' => 'view-project'
            ],
            [
                'name' => 'Update project',
                'slug' => 'update-project'
            ],
            [
                'name' => 'Delete project',
                'slug' => 'delete-project'
            ],
        ]);
    }
}

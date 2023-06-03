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
        $permissions = [
            [
                'name' => 'View Admin Dashboard Screen',
                'slug' => 'view-admin-dashboard-screen'
            ],
            [
                'name' => 'View Employees Screen',
                'slug' => 'view-employees-screen'
            ],
            [
                'name' => 'View Departments Screen',
                'slug' => 'view-departments-screen'
            ],
            [
                'name' => 'View Profile Screen',
                'slug' => 'view-profile-screen'
            ],
            [
                'name' => 'View Change Password Screen',
                'slug' => 'view-change-password-screen'
            ],
            [
                'name' => 'View Register Employee Screen',
                'slug' => 'view-register-employee-screen'
            ],
            [
                'name' => 'View Employee Details screen',
                'slug' => 'view-employee-details-screen'
            ],
            // [
            //     'name' => 'Register Employee',
            //     'slug' => 'register-employee'
            // ],
            // [
            //     'name' => 'Create Department',
            //     'slug' => 'create-department'
            // ],
            // [
            //     'name' => 'Create Post',
            //     'slug' => 'create-post'
            // ],
            // [
            //     'name' => 'View Post',
            //     'slug' => 'view-post'
            // ],
            // [
            //     'name' => 'Delete Post',
            //     'slug' => 'delete-post'
            // ],
            // [
            //     'name' => 'Update Post',
            //     'slug' => 'update-post'
            // ],
            // [
            //     'name' => 'Create Comment',
            //     'slug' => 'create-comment'
            // ],
            // [
            //     'name' => 'Update Comment',
            //     'slug' => 'update-comment'
            // ],
            // [
            //     'name' => 'View Comment',
            //     'slug' => 'view-comment'
            // ],
            // [
            //     'name' => 'Delete Comment',
            //     'slug' => 'delete-comment'
            // ],
            // [
            //     'name' => 'Apply For Leave',
            //     'slug' => 'apply-for-leave'
            // ],
            // [
            //     'name' => 'View Attendance',
            //     'slug' => 'view-attendance'
            // ],
            // [
            //     'name' => 'Update Attendance',
            //     'slug' => 'update-attendance'
            // ],
            // [
            //     'name' => 'View Payslip',
            //     'slug' => 'view-payslip'
            // ],
            // [
            //     'name' => 'Apply For Perks',
            //     'slug' => 'apply-for-perks'
            // ],
            // [
            //     'name' => 'Create Job',
            //     'slug' => 'create-job'
            // ],
            // [
            //     'name' => 'Create Event',
            //     'slug' => 'create-event'
            // ],
            // [
            //     'name' => 'View Event',
            //     'slug' => 'view-event'
            // ],
            // [
            //     'name' => 'Update Event',
            //     'slug' => 'update-event'
            // ],
            // [
            //     'name' => 'Delete Event',
            //     'slug' => 'create-event'
            // ],
            // [
            //     'name' => 'Create Project',
            //     'slug' => 'create-project'
            // ],
            // [
            //     'name' => 'View Project',
            //     'slug' => 'view-project'
            // ],
            // [
            //     'name' => 'Update Project',
            //     'slug' => 'update-project'
            // ],
            // [
            //     'name' => 'Delete Project',
            //     'slug' => 'delete-project'
            // ],
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission['name'],
                'slug' => $permission['slug']
            ]);
        }
    }
}

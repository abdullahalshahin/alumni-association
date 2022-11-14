<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $permissions = [
            'dashboard_view',
            'department_view',
            'department_create',
            'department_edit',
            'department_delete',
            'batch_view',
            'batch_create',
            'batch_edit',
            'batch_delete',
            'session_view',
            'session_create',
            'session_edit',
            'session_delete',
            'group_view',
            'group_create',
            'group_edit',
            'group_delete',
            'defence_view',
            'defence_create',
            'defence_edit',
            'defence_delete',
            'defence_request',
            'defence_verification',
            'event_view',
            'event_create',
            'event_edit',
            'event_delete',
            'notice_view',
            'notice_create',
            'notice_edit',
            'notice_delete',
            'student_view',
            'student_create',
            'student_edit',
            'student_delete',
            'teacher_view',
            'teacher_create',
            'teacher_edit',
            'teacher_delete',
            'user_view',
            'user_create',
            'user_edit',
            'user_delete',
            'role_view',
            'role_create',
            'role_edit',
            'role_delete',
            'setting_view',
            'setting_edit'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}

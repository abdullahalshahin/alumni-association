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
            'dashboard',
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
            'role_delete'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}

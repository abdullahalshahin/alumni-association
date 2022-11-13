<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminUserSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $user = User::create([
            'user_type' => 0,
            'name' => 'Administrator',
            'contact_number' => '+8801XXXXXXXXX',
            'email' => 'administrator@gmail.com',
            'password' => bcrypt('123456'),
            'security' => 123456,
            'gender' => 1,
            'date_of_birth' => '01-01-2000',
            'address' => 'Dhanmondi, Dhaka.',
            'status' => 1
        ]);

        $role = Role::create([
            'name' => 'Administrator',
            'description' => 'A Super Administrator is a user who has complete access to all objects, folders, role templates, and groups in the system.'
        ]);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}

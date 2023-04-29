<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ROLES
        $role1 = Role::create(['name', 'Administrator']);
        $role2 = Role::create(['name', 'Worker']);
        $role3 = Role::create(['name', 'Leader']);

        // PERMISOS

        Permission::create(['name' => '']);
        Permission::create(['name' => '']);
        Permission::create(['name' => '']);
        Permission::create(['name' => '']);
        Permission::create(['name' => '']);
        Permission::create(['name' => '']);
        Permission::create(['name' => '']);
        Permission::create(['name' => '']);
        Permission::create(['name' => '']);
        Permission::create(['name' => '']);
        Permission::create(['name' => '']);
    }
}

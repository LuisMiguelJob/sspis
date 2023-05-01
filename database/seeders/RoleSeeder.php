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
        $roleAdmin = Role::create(['name' => 'Administrator']);
        $roleEmpleado = Role::create(['name' => 'Worker']);
        $roleLider = Role::create(['name' => 'Leader']);

        // PERMISOS

        /* En caso de que querramos poner mas un rol hacia un permiso, debemos de hacerlo de la siguiente manera: */
        /* Permission::create(['name' => 'users.index'])->syncRoles([$role1, $role2]); */

        Permission::create(['name' => 'inicio'])->syncRoles([$roleAdmin, $roleLider, $roleEmpleado]); // usado

        // Acciones por el momento que puede ejecutar un administrador
        Permission::create(['name' => 'users.index'])->assignRole($roleAdmin); // usado
        Permission::create(['name' => 'users.edit'])->assignRole($roleAdmin);
        Permission::create(['name' => 'users.destroy'])->assignRole($roleAdmin);  

        // Acciones por el momento que puede ejecutar un lider
        Permission::create(['name' => 'projects.index'])->syncRoles([$roleLider, $roleEmpleado]); // usado
        Permission::create(['name' => 'projects.create'])->assignRole($roleLider); // usado
        Permission::create(['name' => 'projects.edit'])->assignRole($roleLider);
        Permission::create(['name' => 'projects.destroy'])->assignRole($roleLider);

        // Acciones por el momento que puede ejecutar un lider
        /* Permission::create(['name' => 'tareas.index'])->syncRoles([$roleLider, $roleEmpleado]);
        Permission::create(['name' => 'tareas.create'])->assignRole($roleLider);
        Permission::create(['name' => 'tareas.edit'])->assignRole($roleLider);
        Permission::create(['name' => 'tareas.destroy'])->assignRole($roleLider); */

        // pendiente

        
        
    }
}

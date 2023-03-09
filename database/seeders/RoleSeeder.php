<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //Definir los roles
        $role1 = Role::create(['name' => 'Admin', 'guard_name' => 'web']);
        $role2 = Role::create(['name' => 'Recepcionista', 'guard_name' => 'web']);

        //Define los permisos a cada rol
        Permission::create(['name' => 'dashboard', 'guard_name' => 'web'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'usuarios.index', 'guard_name' => 'web'])->syncRoles([$role1]);
        Permission::create(['name' => 'usuarios.create', 'guard_name' => 'web'])->syncRoles([$role1]);
        Permission::create(['name' => 'usuarios.edit', 'guard_name' => 'web'])->syncRoles([$role1]);
        Permission::create(['name' => 'usuarios.destroy', 'guard_name' => 'web'])->syncRoles([$role1]);

        Permission::create(['name' => 'especialidades.index', 'guard_name' => 'web'])->syncRoles([$role1]);
        Permission::create(['name' => 'especialidades.create', 'guard_name' => 'web'])->syncRoles([$role1]);
        Permission::create(['name' => 'especialidades.edit', 'guard_name' => 'web'])->syncRoles([$role1]);
        Permission::create(['name' => 'especialidades.destroy', 'guard_name' => 'web'])->syncRoles([$role1]);

        Permission::create(['name' => 'medicos.index', 'guard_name' => 'web'])->syncRoles([$role1]);
        Permission::create(['name' => 'medicos.create', 'guard_name' => 'web'])->syncRoles([$role1]);
        Permission::create(['name' => 'medicos.edit', 'guard_name' => 'web'])->syncRoles([$role1]);
        Permission::create(['name' => 'medicos.destroy', 'guard_name' => 'web'])->syncRoles([$role1]);

        Permission::create(['name' => 'exams.index', 'guard_name' => 'web'])->syncRoles([$role1]);
        Permission::create(['name' => 'exams.create', 'guard_name' => 'web'])->syncRoles([$role1]);
        Permission::create(['name' => 'exams.edit', 'guard_name' => 'web'])->syncRoles([$role1]);
        Permission::create(['name' => 'exams.destroy', 'guard_name' => 'web'])->syncRoles([$role1]);

        Permission::create(['name' => 'citas.index', 'guard_name' => 'web'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'citas.create', 'guard_name' => 'web'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'citas.edit', 'guard_name' => 'web'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'citas.destroy', 'guard_name' => 'web'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'paciente.index', 'guard_name' => 'web'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'paciente.create', 'guard_name' => 'web'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'paciente.edit', 'guard_name' => 'web'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'paciente.destroy', 'guard_name' => 'web'])->syncRoles([$role1, $role2]);
    }
}

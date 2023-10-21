<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleAdministrador = Role::create(['name' => 'Administrador']);
        $roleTeacher = Role::create(['name' => 'Teacher']);

        Permission::create(['name'=>'Ver docentes'])->assignRole($roleAdministrador);
        Permission::create(['name'=>'Crear docentes'])->assignRole($roleAdministrador);
        Permission::create(['name'=>'Ver estudiantes'])->syncRoles([$roleTeacher,$roleAdministrador]);
        Permission::create(['name'=>'Crear estudiantes'])->syncRoles([$roleTeacher,$roleAdministrador]);;
        Permission::create(['name'=>'Editar estudiantes'])->syncRoles([$roleTeacher,$roleAdministrador]);;
        Permission::create(['name'=>'Eliminar estudiantes'])->assignRole($roleAdministrador);
        Permission::create(['name'=>'Crear evaluacion'])->assignRole($roleTeacher);
        Permission::create(['name'=>'Crear practica'])->assignRole($roleTeacher);
        Permission::create(['name'=>'Ver evaluacion'])->syncRoles([$roleTeacher,$roleAdministrador]);
        Permission::create(['name'=>'Ver practica'])->syncRoles([$roleTeacher,$roleAdministrador]);
        Permission::create(['name'=>'Editar practica'])->assignRole($roleTeacher);
        Permission::create(['name'=>'Editar evaluacion'])->assignRole($roleTeacher);
    }
}

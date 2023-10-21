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

        Permission::create(['name'=>'Ver docentes']);
        Permission::create(['name'=>'Crear docentes']);
        Permission::create(['name'=>'Ver estudiantes']);
        Permission::create(['name'=>'Crear estudiantes']);
        Permission::create(['name'=>'Editar estudiantes']);
        Permission::create(['name'=>'Eliminar estudiantes']);
        Permission::create(['name'=>'Crear evaluacion']);
        Permission::create(['name'=>'Crear practica']);
        Permission::create(['name'=>'Ver evaluacion']);
        Permission::create(['name'=>'Ver practica']);
        Permission::create(['name'=>'Editar practica']);
        Permission::create(['name'=>'Editar evaluacion']);
    }
}

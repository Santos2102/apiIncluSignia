<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        User::create([
            'firstname' => 'Admin',
            'lastname' => 'Admin',
            'email' => 'inclusignia.admon@gmail.com',
            'password' => 'Bienvenida2023'
        ])->assignRole('Administrador');
    }
}

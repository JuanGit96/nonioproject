<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Role::create([
            'name' 			=>	'Admin',
        ]);

        Role::create([
            'name' 			=>	'Oferta',
        ]);

        Role::create([
            'name' 			=>	'Demanda',
        ]);

        Role::create([
            'name'          =>  'Usuario_oferta',
        ]);
    }
}

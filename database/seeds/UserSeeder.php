<?php

use Illuminate\Database\Seeder;
use App\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' 			=>	'banco@banco.com',
            'password' 			=>	'$2y$10$YmeZCujf6kz3Po1NZ9trfeqRYB71QCNtTB7xjfeL4ZY.3/9WWaNda',
        ]);

        User::create([
            'email' 			=>	'banco2@banco.com',
            'password' 			=>	'$2y$10$YmeZCujf6kz3Po1NZ9trfeqRYB71QCNtTB7xjfeL4ZY.3/9WWaNda',
        ]);

        User::create([
            'email' 			=>	'banco3@banco.com',
            'password' 			=>	'$2y$10$YmeZCujf6kz3Po1NZ9trfeqRYB71QCNtTB7xjfeL4ZY.3/9WWaNda',
        ]);

        User::create([
            'email' 			=>	'banco4@banco.com',
            'password' 			=>	'$2y$10$YmeZCujf6kz3Po1NZ9trfeqRYB71QCNtTB7xjfeL4ZY.3/9WWaNda',
        ]);
        User::create([
            'email' 			=>	'admin@admin.com',
            'password' 			=>	'$2y$10$YmeZCujf6kz3Po1NZ9trfeqRYB71QCNtTB7xjfeL4ZY.3/9WWaNda',
        ]);
    }
}

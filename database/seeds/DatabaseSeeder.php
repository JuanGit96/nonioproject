<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesSeeder::class);
        $this->call(SectorSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(OfferSeeder::class);
        $this->call(RoleUserSeeder::class);
        $this->call(InterestSeeder::class);
        $this->call(AverageInterestSeeder::class);
        $this->call(HeritageCostSeeder::class);



    }
}

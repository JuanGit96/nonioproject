<?php

use Illuminate\Database\Seeder;
use App\HeritageCost;


class HeritageCostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HeritageCost::create([
            'tlr_usa' 			        =>	'6.06',
            'embi' 			            =>	'2.39',
            'tasa_impuestos' 			=>	'40',
            'prima_mercado' 			=>	'5.91',
            'inflacion_colombia' 		=>	'4.09',
            'inflacion_usa' 			=>	'2.11',
        ]);
    }
}

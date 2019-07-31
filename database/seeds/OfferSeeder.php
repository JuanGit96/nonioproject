<?php

use Illuminate\Database\Seeder;
use App\Offer;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Offer::create([
            'user_id' 			=>	'1',
            'nit' 			=>	'1111',
            'name' 			=>	'Bancolombia',
            'ebitda_interes' 			=>	'1.75',
            'of_ebitda' 			=>	'3.80',
            'of_financiacion' 			=>	'60',
        ]);

        Offer::create([
            'user_id' 			=>	'2',
            'nit' 			=>	'2222',
            'name' 			=>	'Davivienda',
            'ebitda_interes' 			=>	'2.25',
            'of_ebitda' 			=>	'3',
            'of_financiacion' 			=>	'70',
        ]);

        Offer::create([
            'user_id' 			=>	'3',
            'nit' 			=>	'3333',
            'name' 			=>	'BBVA',
            'ebitda_interes' 			=>	'1',
            'of_ebitda' 			=>	'2.7',
            'of_financiacion' 			=>	'65',
        ]);

        Offer::create([
            'user_id' 			=>	'4',
            'nit' 			=>	'4444',
            'name' 			=>	'Banco de Bogotá',
            'ebitda_interes' 			=>	'2.5',
            'of_ebitda' 			=>	'4.1',
            'of_financiacion' 			=>	'55',
        ]);
    }
}

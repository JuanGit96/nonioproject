<?php

use Illuminate\Database\Seeder;
use App\Interest;

class InterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 22 ; $i++) { 
            # code...
            Interest::create([
                'offer_id' 			=>	'1',
                'sector_id' 	    =>	$i,
                'noventa'           =>  '16.3',
                'ciento_ochenta'    =>  '15.6',
                'un_ano' 			=>	'13.0',
                'dos_anos' 			=>	'13.2',
                'mas_dos_anos'      =>  '13.6',                
                'average' 			=>	'14.6',
                'state' 			=>	'No',
            ]);

        }

        
        for ($i=1; $i <= 22 ; $i++) { 
            # code...
            Interest::create([
                'offer_id' 			=>	'2',
                'sector_id' 			=>	$i,
                'noventa'           =>  '14',
                'ciento_ochenta'     =>  '14.3',
                'un_ano' 			=>	'13.1',
                'dos_anos' 			=>	'15.7',
                'mas_dos_anos'       =>  '15.8',
                'average' 			=>	'17.7',
                'state' 			=>	'No',
            ]);

        }

        for ($i=1; $i <= 22 ; $i++) { 
            # code...
            Interest::create([
                'offer_id' 			=>	'3',
                'sector_id' 			=>	$i,
                'noventa'           =>  '13.7',
                'ciento_ochenta'            =>  '14.5',
                'un_ano' 			=>	'13.7',
                'dos_anos' 			=>	'15.3',
                'mas_dos_anos'          =>  '15.8',                
                'average' 			=>	'18.8',
                'state' 			=>	'No',
            ]);

        }
        for ($i=1; $i <= 22 ; $i++) { 
            # code...
            Interest::create([
                'offer_id' 			=>	'4',
                'sector_id' 			=>	$i,
                'noventa'           =>  '14.5',
                'ciento_ochenta'            =>  '13.6',
                'un_ano' 			=>	'15.7',
                'dos_anos' 			=>	'14.3',
                'mas_dos_anos'          =>  '15.8',
                'average' 			=>	'16.3',
                'state' 			=>	'No',
            ]);

        }
        
    }
}

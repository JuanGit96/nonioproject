<?php

use Illuminate\Database\Seeder;
use App\AverageInterest;
use App\Offer;
use App\Interest;


class AverageInterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offer= Offer::all();
        for ($i=0; $i < count($offer); $i++) { 
            # code....
            $sector1= Interest::where('offer_id',$offer[$i]->id)->where('sector_id',1)->first();
            $sector2= Interest::where('offer_id',$offer[$i]->id)->where('sector_id',2)->first();
            $sector3= Interest::where('offer_id',$offer[$i]->id)->where('sector_id',3)->first();
            $sector4= Interest::where('offer_id',$offer[$i]->id)->where('sector_id',4)->first();
            $sector5= Interest::where('offer_id',$offer[$i]->id)->where('sector_id',5)->first();
            $sector6= Interest::where('offer_id',$offer[$i]->id)->where('sector_id',6)->first();
            $sector7= Interest::where('offer_id',$offer[$i]->id)->where('sector_id',7)->first();
            $sector8= Interest::where('offer_id',$offer[$i]->id)->where('sector_id',8)->first();
            $sector9= Interest::where('offer_id',$offer[$i]->id)->where('sector_id',9)->first();
            $sector10= Interest::where('offer_id',$offer[$i]->id)->where('sector_id',10)->first();
            $sector11= Interest::where('offer_id',$offer[$i]->id)->where('sector_id',11)->first();
            $sector12= Interest::where('offer_id',$offer[$i]->id)->where('sector_id',12)->first();
            $sector13= Interest::where('offer_id',$offer[$i]->id)->where('sector_id',13)->first();
            $sector14= Interest::where('offer_id',$offer[$i]->id)->where('sector_id',14)->first();
            $sector15= Interest::where('offer_id',$offer[$i]->id)->where('sector_id',15)->first();
            $sector16= Interest::where('offer_id',$offer[$i]->id)->where('sector_id',16)->first();
            $sector17= Interest::where('offer_id',$offer[$i]->id)->where('sector_id',17)->first();
            $sector18= Interest::where('offer_id',$offer[$i]->id)->where('sector_id',18)->first();
            $sector19= Interest::where('offer_id',$offer[$i]->id)->where('sector_id',19)->first();
            $sector20= Interest::where('offer_id',$offer[$i]->id)->where('sector_id',20)->first();
            $sector21= Interest::where('offer_id',$offer[$i]->id)->where('sector_id',21)->first();
            $sector22= Interest::where('offer_id',$offer[$i]->id)->where('sector_id',22)->first();

            $agricultura= $sector1->average;
            $explotacion= $sector2->average;
            $industria= $sector3->average;
            $electricidad= $sector4->average;
            $agua= $sector5->average;
            $construccion= $sector6->average;
            $comercio= $sector7->average;
            $transporte= $sector8->average;
            $alojamiento= $sector9->average;
            $comunicaciones= $sector10->average;
            $financieras= $sector11->average;
            $inmobiliarias= $sector12->average;
            $cientificas= $sector13->average;
            $administrativos= $sector14->average;
            $publica= $sector15->average;
            $educacion= $sector16->average;
            $salud= $sector17->average;
            $arte= $sector18->average;
            $otras= $sector19->average;
            $hogares= $sector20->average;
            $organizaciones= $sector21->average;
            $noincluidas= $sector22->average;

            AverageInterest::create([
                'offer_id' 			=>	$offer[$i]->id,
                'agricultura' 			=>	$agricultura,
                'explotacion' 			=>	$explotacion,
                'industria' 			=>	$industria,
                'electricidad' 			=>	$electricidad,
                'agua' 			=>	$agua,
                'construccion' 			=>	$construccion,
                'comercio' 			=>	$comercio,
                'transporte' 			=>	$transporte,
                'alojamiento' 			=>	$alojamiento,
                'comunicaciones' 			=>	$comunicaciones,
                'financieras' 			=>	$financieras,
                'inmobiliarias' 			=>	$inmobiliarias,
                'cientificas' 			=>	$cientificas,
                'administrativos' 			=>	$administrativos,
                'publica' 			=>	$publica,
                'educacion' 			=>	$educacion,
                'salud' 			=>	$educacion,
                'arte' 			=>	$arte,
                'otras' 			=>	$otras,
                'hogares' 			=>	$hogares,
                'organizaciones' 			=>	$organizaciones,
                'noincluidas' 			=>	$noincluidas,
            ]);

        }
    }
}

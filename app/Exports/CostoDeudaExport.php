<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CostoDeudaExport implements FromQuery, WithHeadings
{


    use Exportable; #Acceder al metodo download

    /**
    * @return \Illuminate\Database\Query\Builder
    */
    public function query()
    {
        return
            DB::
            table('average_interests')
                ->select($this->select())
                ->join('offers', 'offers.id', 'average_interests.offer_id')
                ->orderBy('average_interests.id');
    }

    public function select ()
    {
        return [
            'offers.name as banco',
            "average_interests.agricultura",
            "average_interests.explotacion",
            "average_interests.industria",
            "average_interests.electricidad",
            "average_interests.agua",
            "average_interests.construccion",
            "average_interests.comercio",
            "average_interests.transporte",
            "average_interests.alojamiento",
            "average_interests.comunicaciones",
            "average_interests.financieras",
            "average_interests.inmobiliarias",
            "average_interests.cientificas",
            "average_interests.administrativos",
            "average_interests.publica",
            "average_interests.educacion",
            "average_interests.salud",
            "average_interests.arte",
            "average_interests.otras",
            "average_interests.hogares",
            "average_interests.organizaciones",
            "average_interests.noincluidas",
        ];
    }

    public function headings(): array
    {
        return [
            "banco",
            "agricultura",
            "explotacion",
            "industria",
            "electricidad",
            "agua",
            "construccion",
            "comercio",
            "transporte",
            "alojamiento",
            "comunicaciones",
            "financieras",
            "inmobiliarias",
            "cientificas",
            "administrativos",
            "publica",
            "educacion",
            "salud",
            "arte",
            "otras",
            "hogares",
            "organizaciones",
            "noincluidas",
        ];
    }
}

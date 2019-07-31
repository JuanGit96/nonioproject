<?php

namespace App\Exports;

use App\Application;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SolicitudesExport implements FromQuery, WithHeadings
{


    use Exportable; #Acceder al metodo download

    /**
     * @return \Illuminate\Database\Query\Builder
     */
    public function query()
    {
        return

            Application::
            select($this->select())
            ->join('indebtedness_capacities','indebtedness_capacities.id','applications.indebtedness_capacities_id')
            ->join('offers','offers.id','indebtedness_capacities.offers_id')
            ->join('simulations','simulations.id','indebtedness_capacities.simulation_id')
            ->join('sectors','sectors.id','simulations.sector_id')
            ->join('simulation_demands','simulation_demands.simulation_id','indebtedness_capacities.simulation_id')
            ->join('demands','demands.id','simulation_demands.demand_id');

    }

    public function select ()
    {
        return [
            'applications.created_at as fecha',
            'demands.name_company as empresa',
            'sectors.name as sector',
            'applications.value as monto',
            'offers.name as banco',
            'applications.interest_rate as tasa',
            'applications.terms as plazo',
            DB::raw("IF('indebtedness_capacities.wacc < simulation_demands.roic', 'SI', 'NO') as ASDASD"),
            'applications.state as estado',
        ];
    }

    public function headings(): array
    {
        return [
            'Fecha',
            'Empresa',
            'Sector',
            'Monto',
            'Entidad',
            'Tasa',
            'Plazo',
            'Genera Valor',
            'Estado'
        ];
    }
}

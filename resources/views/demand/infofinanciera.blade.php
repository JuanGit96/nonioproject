@extends('layouts.app')
@section('content')
<section style="min-height: 100vh;">
    <div class="row m-0 ">
        <div class="col text-center mt-3">
            <h1>Información Financiera</h1>
        </div>
    </div>
@foreach($info as $infos)
    <div class="row solicitudes mt-4">
         <div class="col-lg-6 pl-5">
            <div class="row">
                <div class="col">
                    <h4>Datos Financieros</h4>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col">
                    <p>Sector :  {{$infos->name}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p>Fecha de la información financiera : {{$infos->date}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p>Ingresos : ${{number_format($infos->income)}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p>Costos de ventas: ${{number_format($infos->sale_value)}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p>Gastos de operación: ${{number_format($infos->operating_costs)}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p>Gastos de depreciación : ${{number_format($infos->depreciation_costs)}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p>Gastos de amortización : ${{number_format($infos->amortization_costs)}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p>Saldo de obligaciones financieras : ${{number_format($infos->financial_obligations)}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p>Valor del patrimonio : ${{number_format($infos->heritage_value)}}</p>
                </div>
            </div>
            <div class="row">
                    <div class="col">
                        <p>Email de contacto: {{$infos->email_contact}}</p>
                    </div>
                </div>
            <div class="row">
                    <div class="col">
                        <a href="{{route('get_editInfoFinanciera',$infos->id)}}">
                            <button class="btn btn-info">EDITAR</button>
                        </a>
                    </div>
                </div>
        </div>
        
    </div>
@endforeach
</section>

@endsection()

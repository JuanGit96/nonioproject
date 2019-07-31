@extends('layouts.app')
@section('content')
<section style="min-height: 100vh;">
    <div class="row m-0 ">
        <div class="col text-center mt-3">
            <h1>Historial de solicitudes</h1>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col">
            <table class="table table-striped" id="tabla_entidades">
                <thead class="thead ">
                    <tr class="head-table text-center">
                        <th scope="col">Fecha</th>
                        <th scope="col">Monto</th>
                        <th scope="col">Entidad{{--Banco--}}</th>
                        <th scope="col">Tasa</th>
                        <th scope="col">Plazo</th>
                        <th scope="col">Estado</th>
                    </tr>
                </thead>
                <tbody class="body-admin text-center">
                    @foreach($info as $infos)
                    <tr>
                        <td>{{date_format(date_create($infos->fecha),"d/m/Y")}}</td>
                        <td>${{number_format($infos->value)}}</td>
                        <td>{{$infos->banco}}</td>
                        <td>{{$infos->tasa}}%</td>
                        <td>@if($infos->plazo == "90" || $infos->plazo == "180"){{str_finish($infos->plazo," días")}} @else() {{$infos->plazo}} @endif()</td>
                        <td>
                            <h4>
                                <span class="badge @if($infos->estado == 'Iniciado')text-info @elseif($infos->estado == 'En estudio')text-warning @elseif($infos->estado == 'Aceptada') text-success @elseif($infos->estado == 'Rechazada') text-danger @elseif($infos->estado == 'Vencida') text-danger @endif()"  >{{$infos->estado}}</span>
                            </h4>
                        </td>
                    </tr>
                    @endforeach()
                </tbody>
            </table>
        </div>
    </div>
</section>

@endsection()


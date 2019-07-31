@extends('layouts.app')
@section('content')
<div class="row mt-4">
    <div class="col">
        <table class="table table-striped" id="tabla_entidades">
          <thead class="thead ">
            <tr class="head-table text-center">
              <th scope="col">Fecha</th>
              <th scope="col">Empresa</th>
              <th scope="col">Sector</th>
              <th scope="col">Monto</th>
              <th scope="col">Estado</th>
              <th scope="col">Respuesta</th>
            </tr>
          </thead>
          <tbody class="body-admin text-center">
            @foreach($solicitud as $solicitudes)
            <tr>
                <td>{{date_format(date_create($solicitudes->fecha),"d/m/Y  H:i:s")}}</td>
                <td>{{$solicitudes->empresa}}</td>
                <td>{{$solicitudes->sector}}</td>
                <td>${{number_format($solicitudes->monto)}}</td>
                <td>
                    <a role="button" style="font-size: 13px;" aria-disabled="true" class="disabled @if($solicitudes->estado == 'En estudio' || $solicitudes->estado == 'Aceptada' || $solicitudes->estado == 'Contactado')btn btn-warning @elseif($solicitudes->estado == 'Finalizado') btn btn-success @elseif($solicitudes->estado == 'Rechazada') btn btn-danger @else btn btn-info @endif() " href="#">
                    @if($solicitudes->estado == 'Finalizado') Desembolsado @else {{$solicitudes->estado}} @endif()
                    </a>
                </td>
                <td>@if($solicitudes->estado== 'Finalizado' || $solicitudes->estado== 'Rechazada')
                    <p id="terminada{{$solicitudes->id}}"></p>
                    @else
                    @endif()
                </td>
            </tr>
            @endforeach()
          </tbody>
        </table>
    </div>
</div>
@endsection()
@section('script')
  <script>
    $(document).ready(function () {
        
       
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); 
        
        $.ajax({
            method: "GET",
            url: "{{url('showterminada')}}"
        }).done((res) => {
            res.forEach(function(serv) {
                var fecha_creacion = new Date(Date.parse(serv.created_at));
                fecha_creacion.setDate(fecha_creacion.getDate() + 3 );
                var con_plazo = Date.parse(fecha_creacion);
                
                var fecha_terminada = new Date(Date.parse(serv.updated_at));

                var distance = fecha_creacion - fecha_terminada;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));

                // Output the result in an element with id="demo"
                document.getElementById("terminada"+serv.id).innerHTML = days + "d " + hours + "h "
                + minutes + "m ";
                
            });
        }).fail((error) => {
                alert("error, no se puede traer la información solicitada");
        });
    });
  
  </script>
@endsection()
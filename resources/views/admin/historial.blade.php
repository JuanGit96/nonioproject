@extends('layouts.app')
@section('content')
<div class="row mt-3">
    <div class="col-xs-12 col-sm-3">
    <!-- Filtro de tabla clientes -->
        <table id="filter-table">
            <thead>
            <tr>
            <th>Sector</th>
            <th>Entidad</th>
            <th>Plazo</th>
            <th>Estado</th>
            </tr>
            </thead>
            <tbody>
            <tr >
                <td id="filter_col2" data-column="2">
                <select class="column_filter_historial form-control"   id="col2_filter">
                    <!-- Recorre el dato enviado desde el servidor de todas las comunidades -->
                    <option value="" >Filtrar</option>
                    @foreach ($sectores as $s)
                    <option >{{$s->name}}</option>
                    @endforeach()
                </select>
                </td>
                <td id="filter_col4" data-column="4">
                <select class="column_filter_historial form-control"   id="col4_filter">
                    <!-- Recorre el dato enviado desde el controlador de todos los usuarios -->
                    <option value="" >Filtrar</option>
                    @foreach ($Banco as $b)
                        <option >{{$b->name}}</option>
                    @endforeach()
                </select>
                </td>
                <td id="filter_col7" data-column="7">
                <select class="column_filter_historial form-control"   id="col7_filter">
                    <option value=""  >Filtrar</option>
                    <option >60</option>
                    <option >90</option>
                    <option >180</option>
                    <option >360</option>
                </select>
                </td>
                <td id="filter_col9" data-column="9">
                <select class="column_filter_historial form-control"   id="col7_filter">
                    <option value="" >Filtrar</option>
                    <option>Aceptada</option>
                    <option>Rechazada</option>
                    <option>Vencida</option>
                </select>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row mt-4">
    <div class="col">
        <table class="table table-striped bg-white" id="historial_table" style="width:100%">
          <thead class="thead ">
            <tr class="head-table text-center">
              <th scope="col">Fecha</th>
              <th scope="col">Empresa</th>
              <th scope="col">Sector</th>
              <th scope="col">Monto</th>
              <th scope="col">Entidad</th>
              <th scope="col">Tasa</th>
              <th scope="col">Plazo</th>
              <th scope="col">Estado</th>
              <th scope="col">Respuesta</th>
            </tr>
          </thead>
          <tbody class="body-admin text-center">
            @foreach($solicitud as $solicitudes)
            <tr>
                <td>{{$solicitudes->fecha}}</td>
                <td>{{$solicitudes->empresa}}</td>
                <td>{{$solicitudes->sector}}</td>
                <td>{{number_format($solicitudes->monto)}}</td>
                <td>{{$solicitudes->banco}}</td>
                <td>{{$solicitudes->tasa}}</td>
                <td>{{$solicitudes->plazo}}</td>
                <td>{{$solicitudes->estado}}</td>
                <td>
                    @if($solicitudes->estado== 'Aceptada' || $solicitudes->estado== 'Rechazada')
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
            url: "/showterminada/"
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

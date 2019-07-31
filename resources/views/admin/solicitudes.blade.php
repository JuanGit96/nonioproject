@extends('layouts.app')
@section('content')
<div class="row mt-3">
    <div class="col-md-12">
        <div class="col-md-6 col-xs-12 col-sm-3">
            <!-- Filtro de tabla clientes -->
            <table id="filter-table">
                <thead>
                <tr>
                    <th>Sector</th>
                    <th>Entidad</th>
                    <th>Empresa</th>
                    <th>Plazo</th>
                    <th>Estado</th>
                </tr>
                </thead>
                <tbody>
                <tr >
                    <td id="filter_col2" data-column="2">
                        <select class="column_filter form-control"   id="col2_filter">
                            <!-- Recorre el dato enviado desde el servidor de todas las comunidades -->
                            <option value="" >Filtrar</option>
                            @foreach ($sectores as $s)
                                <option >{{$s->name}}</option>
                            @endforeach()
                        </select>
                    </td>
                    <td id="filter_col4" data-column="4">
                        <select class="column_filter form-control"   id="col4_filter">
                            <!-- Recorre el dato enviado desde el controlador de todos los usuarios -->
                            <option value="" >Filtrar</option>
                            @foreach ($Banco as $b)
                                <option >{{$b->name}}</option>
                            @endforeach()
                        </select>
                    </td>
                    <td id="filter_col1" data-column="1">
                        <select class="column_filter form-control"   id="col1_filter">
                            <!-- Recorre el dato enviado desde el controlador de todos los usuarios -->
                            <option value="" >Filtrar</option>
                            @foreach ($empresas as $e)
                                <option >{{$e->name_company}}</option>
                            @endforeach()
                        </select>
                    </td>
                    <td id="filter_col7" data-column="7">
                        <select class="column_filter form-control"   id="col7_filter">
                            <option value=""  >Filtrar</option>
                            <option >90</option>
                            <option >180</option>
                            <option >1 año</option>
                            <option >2 años</option>
                            <option >más de 2 años</option>
                        </select>
                    </td>
                    <td id="filter_col9" data-column="9">
                        <select class="column_filter form-control"   id="col9_filter">
                            <option value="" >Filtrar</option>
                            <option  >En estudio</option>
                            <option  >Iniciado</option>
                            <option  >Aceptada</option>
                            <option  >Rechazada</option>
                            <option  >Vencida</option>
                            <option  >Contactado</option>
                            <option  >Desembolsado</option>
                        </select>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-6 mt-4">
            <button class="btn btn-primary downloadReport" style="">DESCARGAR INFORME <i class="fa fa-download"></i></button>
        </div>
    </div>

</div>
<div class="row mt-4">
    <div class="col">
        <table class="table table-striped bg-white" id="solicitudes_table" style="width:100%">
          <thead class="thead ">
            <tr class="head-table text-center">
              <th scope="col">Fecha</th>
              <th scope="col">Empresa</th>
              <th scope="col">Sector</th>
              <th scope="col">Monto</th>
              <th scope="col">Entidad</th>
              <th scope="col">Contador Tiempo</th>
              <th scope="col">Tasa</th>
              <th scope="col">Plazo</th>
              <th scope="col">Genera Valor</th>
              <th scope="col">Estado</th>
            </tr>
          </thead>
          <tbody class="body-admin text-center">
            @foreach($solicitud as $solicitudes)
            <tr>
                <td>{{date_format(date_create($solicitudes->fecha),"d/m/Y")}}</td>
                <td>{{$solicitudes->empresa}}</td>
                <td>{{$solicitudes->sector}}</td>
                <td>{{number_format($solicitudes->monto)}}</td>
                <td>{{$solicitudes->banco}}</td>
                <td id="demo{{$solicitudes->id}}"></td>
                <td>{{$solicitudes->tasa}}</td>
                <td>{{$solicitudes->plazo}}</td>
                <td>
                    @if($solicitudes->roic > $solicitudes->wacc)
                    Si
                    @else
                    No
                    @endif()
                </td>
                <td>@if($solicitudes->estado == 'Finalizado') Desembolsado @else {{$solicitudes->estado}} @endif()</td>
            </tr>
            @endforeach()
          </tbody>
        </table>
    </div>
</div>
@endsection()
@section('script')
<script>
    
    var x = setInterval(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "get",
            url: "/showtime",
        }).done((res) => {

            res.forEach(function(serv) {
                var fecha_creacion = new Date(Date.parse(serv.created_at));
                fecha_creacion.setDate(fecha_creacion.getDate() + 5 );
                var con_plazo = Date.parse(fecha_creacion);

                var now = new Date().getTime();

                var distance = con_plazo - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Output the result in an element with id="demo"

                document.getElementById("demo"+serv.id).innerHTML = days + "d " + hours + "h "
                + minutes + "m " + seconds + "s ";
                
                // If the count down is over, write some text 
                if (distance < 0) {
                    clearInterval(x);
                    datos = {
                        'id_aplicacion': serv.id,
                        'estado': "Vencida",
                    };
                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    });
                    $.ajax({
                        method: "PUT",
                        url: "/changestate",
                        data: datos 
                    }).done((res) => {
                        location.reload();
                    }).fail((error) => {
                    });
                }
            });
            
        }).fail((error) => {
            //Si la repuesta al controlador no es correcta, se muestra un modal con el error.
        });
    }, 1000);
</script>


<script>
    $(".downloadReport").click(function () {

        location.href = "{{route('get_solicitudes_excel')}}";

    });
</script>

@endsection()



@extends('layouts.app')
@section('content')
<section style="min-height: 100vh;">
    <div class="row m-0 ">
        <div class="col text-center mt-3">
            <h1>Mi Solicitud</h1>
        </div>
    </div>
    @if ($infos)
    
    <div class="row solicitudes mt-4">
        <div class="col-lg-6 pl-5">
            <div class="row">
                <div class="col">
                    <h4>Datos de la solicitud</h4>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p>Sector :  {{$infos->nombresector}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p>Ingresos : ${{number_format($infos->income)}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p>Costos de ventas : ${{number_format($infos->sale_value)}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p>Costos Operativos : ${{number_format($infos->operating_costs)}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p>Costos de Depreciación : ${{number_format($infos->depreciation_costs)}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p>Costos de Amortización : ${{number_format($infos->amortization_costs)}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p>Obligaciones financieras : ${{number_format($infos->financial_obligations)}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p>Patrimonio : ${{number_format($infos->heritage_value)}}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col">
                    <h4>Fecha</h4>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p>{{date_format(date_create($infos->fecha),"d/m/Y")}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h4>Valor requerido</h4>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    {{--<p>${{number_format($infos->valor)}}</p>--}}
                    <p>${{number_format($value)}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h4>Entidad solicitada{{--Banco solicitado--}}</h4>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p>{{$infos->banco}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h4>Tasa <small>{{$infos->tasa}}%</small></h4>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h4>Plazo <small>@if($infos->plazo == "90" || $infos->plazo == "180"){{str_finish($infos->plazo," días")}} @else() {{$infos->plazo}} @endif()</small></h4>
                </div>
            </div>
            <div class="row d-none">
                <div class="col">
                    <h4>Capacidad de endeudamiento respecto a la entidad</h4>
                </div>
            </div>
            <div class="row d-none">
                <div class="col">
                    <p>${{number_format($infos->capacidad)}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h4 class="mt-0">Estado de la Solicitud</h4>
                </div>
            </div>
            <div class="row pt-2 pb-2">
                <div class="col">
                    <h2><span class="badge @if($infos->estado == 'Iniciado')text-info @elseif($infos->estado == 'En estudio')text-warning @elseif($infos->estado == 'Aceptada') text-success @elseif($infos->estado == 'Rechazada') text-danger @elseif($infos->estado == 'Vencida') text-danger @endif()"  >{{$infos->estado}}</span></h2>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p class="mb-0" style="display:none;" id="demoT">Tiempo de estudio restante</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div id="demo{{$infos->appId}}"></div>
                    <span class="row text-center alert alert-warning" style="display:none;" id="alertaCambioP">
                        <small>Solo tenías 24 horas para editar o cancelar la solicitud</small>
                    </span>
                    <span class="row text-center alert alert-info" style="display:none;" id="alertaCambio">
                        <small id="tiempoEdicion"></small>
                    </span>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if(isset($infos->estado))
        @if($infos->estado == 'Iniciado')
            <div class="edit_modify">
                <br><br>
                <div class="row m-0 ">
                    <div class="col text-center mt-3">
                        <h1>Edita tu solicitud</h1>
                    </div>
                </div>
                <br>
                <form action="" id="edit_sol">
                    <div class="form-row">
                        <div class="col mb-3">
                            <label for="validationCustom02">Plazo del préstamo:</label>
                            <select  class="custom-select" name="plazo" id="plazo" required>
                                <option value="90" selected>90 días</option>
                                <option value="180">180 días</option>
                                <option value="un_ano" >1 año</option>
                                <option value="dos_anos" >2 años</option>
                                <option value="mas_dos_anos" >más de 2 años</option>

                            </select>

                        </div>
                        <div class="col mb-3">
                            <label for="validationCustomUsername">Monto del prestamo :</label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <button class="btn btn-light slider_button" type="button" onclick="montoMenos()">-</button>
                                </div>
                                <input type="range" min="5000000" max="{{$max}}" step="500000" value="{{$value}}" class="slider form-control" id="monto" >
                                <div class="input-group-append">
                                    <button class="btn btn-light slider_button" type="button" onclick="montoMas()">+</button>
                                </div>
                            </div>
                            <p>$ <span id="Montocantidad"></span></p>
                        </div>
                        <div class="col mb-3">
                            <label for="validationCustomUsername">Monto del prestamo :</label>
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">COP</span>
                                <input type="text" class="form-control" value="{{number_format($value)}}" id="input_value" aria-describedby="basic-addon3">
                            </div>
                        </div>
                    </div>
                    <span class="row text-center alert alert-info">
                        <i class="fa fa-info-circle"></i>&nbsp;Recuerda que tu monto inicial elegido fue de : COP {{number_format($value)}}
                    </span>
                    <div class="form-row">
                        <div class="col mb-3">
                            <button type="submit" class="btn btn-primary">Actualizar Solicitud <i class="fa fa-pencil-alt"></i></button>
                        </div>
                        <div class="col mb-3">
                            <button id="delete_sol" type="button" class="btn btn-danger offset-8">Cancelar Solicitud <i class="fa fa-window-close"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        @endif
    @endif
</section>

@endsection()

@section('script')
@if(isset($solicitud_id))
    <script>
        //Cuando se recorre el campo de monto

        $(document).on('input', '#monto', function() {
            $minimo = $(this).val();
            valorcouta = $minimo.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
            document.getElementById("input_value").value = valorcouta;
        });

        $( "#edit_sol" ).submit(function( event ) {
            event.preventDefault();

            var url  = "{{route('editar_solicitud',[$solicitud_id,"%value%",'%plazo%'])}}";

            url = url.replace('%value%',$('#monto').val());
            url = url.replace('%plazo%',$('#plazo').val());

            location.href = url;
        });

        $("#delete_sol").click(function () {

            swal({
                title: "¿Estás seguro?",
                text: "",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Sí, seguro",
                cancelButtonText: "Cancelar",
                closeOnConfirm: true
            }, function () {


                route  = "{{route('eliminar_solicitud',[$solicitud_id])}}";

                location.href = route;


            });


        });
    </script>
@endif
<script>

    var x = setInterval(function() {



        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "get",
            url: "{{url('showtime')}}"
        }).done((res) => {
            
            if (res.length > 0){
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
                if (document.getElementById("demo"+serv.id) !== null){
                document.getElementById("demo"+serv.id).innerHTML = days + "d " + hours + "h "
                + minutes + "m " + seconds + "s ";
                        $("#demoT").show();
                        //Bloquear edicion y eliminacion Si ha pasado una hora desde la creacion de la solicitud

                        if(days <= 3 && hours <= 23 && minutes <= 59 && seconds <= 59)
                        {
                            //se bloquea edicion y eliminacion de solicitud
                            $(".edit_modify").css('display','none');
                            $("#alertaCambioP").show();
                        }
                        else
                        {
                            if (hours == 1)
                            {
                                $("#alertaCambio").show();
                                $("#tiempoEdicion").html("Te quedan " + hours + " hora y "+ minutes+ " minutos y "+seconds+" segundos para editar o cancelar la solicitud");
                            }
                            else
                            {
                                $("#alertaCambio").show();
                                $("#tiempoEdicion").html("Te quedan " + hours + " horas y "+ minutes+ " minutos y "+seconds+" segundos para editar o cancelar la solicitud");
                            }
                        }




                        //else if (horus > 4){
                          //  var diasEditar = days - 4;
                            //var horasEditar = (hours) + ((diasEditar * 24)-1);
                            //$("#alertaCambio").show();
                            //$("#tiempoEdicion").html("Te quedan " + horasEditar + " horas y "+ minutes+ " minutos para editar o cancelar la solicitud");
                        //}else if (days==4 && hours > 4){
                          //  var horasEditar = hours;
                            //$("#alertaCambio").show();
                            //if (horasEditar == 1){
                              //  $("#tiempoEdicion").html("Te queda " + horasEditar + " hora y "+ minutes+ " minutos para editar o cancelar la solicitud");
                            //}else{
                              //  $("#tiempoEdicion").html("Te quedan " + horasEditar + " horas y "+ minutes+ " minutos para editar o cancelar la solicitud");
                           // }
                       // }else if (days==4 && hours == 4){
                         //   $("#alertaCambio").show();
                           // $("#tiempoEdicion").html("Te quedan "+ minutes+ " minutos para editar o cancelar la solicitud");
                      //  }
                }else{
                    $("#demoT").hide();
                }  
                
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
                        url: "{{url('changestate')}}",
                        data: datos 
                    }).done((res) => {
                        location.reload();
                        
                    }).fail((error) => {
                    });
                }

            });
            }else{
                $("#demoT").hide();
            }
            
        }).fail((error) => {
            console.log(error);
            //Si la repuesta al controlador no es correcta, se muestra un modal con el error.
        });
    }, 1000);
    
    function montoMenos(){
        var monto = parseInt(document.getElementById("monto").value);
        var paso = parseInt($("#monto").attr("step"));
        var min = parseInt($("#monto").attr("min"));
        if (monto-paso >= min){
            monto = monto - paso;
        }else{
            monto = min;
        }
        $("#monto").val(monto);
        document.getElementById("Montocantidad").innerHTML = monto.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        cargarTabla(monto);
    }
    function montoMas(){
        var monto = parseInt(document.getElementById("monto").value);
        var paso = parseInt($("#monto").attr("step"));
        var max = parseInt($("#monto").attr("max"));
        if (monto + paso <= max){
            monto = monto + paso;
        }else{
            monto = max;
        }
        $("#monto").val(monto);
        document.getElementById("Montocantidad").innerHTML = monto.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        cargarTabla(monto);
    }
</script>

@endsection()

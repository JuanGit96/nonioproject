@extends('layouts.app')
<!-- header alternativo -->
@section('content')
<!-- banner -->
<section class="bannerSimulation ">
    <div class="text-bannerm col p-0 ">
        <img class = "banner" src="{{asset('img/bannerMarket.jpg')}}" alt="" width="100%">
        <div class="row title">
            <div class="col d-none d-lg-block d-xl-block d-md-block "></div>
            <div class="col text-center  d-none d-lg-block d-xl-block d-md-block">
                <h5>Compara las opciones de nuestra red de aliados y solicíta una opción de financiamiento en un clic</h5>
            </div>
        </div>
    </div>
</section>
<!-- fin banner -->
<!-- Formulario -->
<section class="form-market container mt-3 mb-4" >
    <div class="row">
        <div class="col text-center">
            <h3>Elige tu entidad financiera</h3>
        </div>
    </div>
    <div class="row">
        <div class="col" align="center">
            <p>Compara las opciones de nuestra red de aliados y solicíta una opción de financiamiento en un clic</p>
        </div>
    </div>
    <form action="" id="clients">
        <div class="form-row">
            <div class="col mb-3">
                <label for="validationCustom02">Plazo del préstamo:</label>
                <select  class="custom-select" name="plazo" id="plazo" required>
                    <option selected value="90">90 días</option>
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
        <span class="alert alert-info">
            <i class="fa fa-info-circle"></i>
            Recuerda que tu monto inicial elegido fue de : COP {{number_format($value)}}
        </span>
    </form>
</section>

<!-- Tabla -->
<table class="table table-striped" id="tabla_entidades">
  <thead class="thead ">
    <tr class="text-center">
        <th colspan="5" class="titulotable" > <span id="num" ></span> <span id="opciones"></span>  </th>
    </tr>
    <tr class="head-table text-center">
      <th scope="col">Entidad financiera</th>
      <th scope="col">Monto </th>
      <th scope="col">Tasa de Interés (%EA)</th>
      <th scope="col">Plazo</th>
      <th scope="col">Más Info</th>
    </tr>
    
  </thead>
  <tbody class="rowtable" id="body_entidades">
  </tbody>
</table>
<!-- Fin formulario -->
<!-- modal -->
<div class="modal fade" id="vermas_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row mb-2">
            <div class="col text-center" >
                <h4 id="banco"></h4>
            </div>
        </div>
        <div class="row">
            <div class="col " >
                <p>Préstamo Total:</p>
            </div>
            <div class="col " >
                <p id="prestamo"></p>
            </div>
        </div>
        <div class="row">
            <div class="col " >
                <p>Tasa de Intéres:</p>
            </div>
            <div class="col " >
                <p id="tasa"></p>
            </div>
        </div>
        <div class="row">
            <div class="col " >
                <p>Plazo:</p>
            </div>
            <div class="col " >
                <p id="plazomodal"></p>
            </div>
        </div>
        <div class="row mt-2 mb-2">
            <div class="col text-center" >
                <a  class="btn btn-form"   id="solicitarbtn" >Solicitar</a>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- fin modal -->
<!-- modal -->
<div class="modal fade" id="solicitar_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
            <div class="col text-center" >
                <h3> ¡ Felicitaciones !</h3>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col text-center" >
                <img src="{{asset('img/Like.png')}}" alt="" width="30%">
            </div>
        </div>
        <div class="row">
            <div class="col" align="center">
                <p >Recuerda que solo puedes solicitar con uno de nuestros aliados, si esta solicitud no es efectiva puedes hacer otra solicitud en los próximos 5 días después de no ser aprobada.</p>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <?php $demand = DB::table('demands')->where('user_id',Auth::user()->id)->first(); ?>
        <a id="acep"  role="button" href="{{url('/solicitud/'.$demand->id)}}" class="btn btn-primary">Aceptar</a>
      </div>
    </div>
  </div>
</div>
@endsection()
@section('script')
<script>
// Al empezar la vista carga la tabla
// 
    var habilitado = "{{$habilitado}}";
    var urlApplication = "{{url('/application')}}";
    $(document).ready(function () {

        if (habilitado == 'disabled'){
            swal("Importante", "Recuerda que solo puedes solicitar una de las opciones, si no es efectiva, más adelante encontrarás cuáles entidades están disponibles", "success");
        }
        $minimo = {{$value}};
        cargarTabla($minimo);
    });

    function cargarTabla($minimo){
        $plazo=  document.getElementById("plazo").value;
        $id={{$simulation_id}};
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); 
        $.ajax({
            method: "GET",
            url: "{{url('getoffers')}}/" + $id +"/" +$minimo
        }).done((res) => {
            if (res.count<1){
                document.getElementById("num").innerHTML= "";
                document.getElementById("opciones").innerHTML= "No hay opciones disponibles";
            }else if (res.count<=1) {
                document.getElementById("num").innerHTML= "Una";
                document.getElementById("opciones").innerHTML= " opcion disponible";
            }else{
                document.getElementById("opciones").innerHTML= "opciones disponibles ";
                document.getElementById("num").innerHTML= res.count;
            }
            $('#body_entidades').html("");
            $var=0
            var valorcouta = $minimo.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
            document.getElementById("input_value").value = valorcouta;
            res.clients.forEach(function(serv) {
              $plazoStr = $plazo + "";
              if($plazo == 90){
                    $plazoStr = "90 días";
                    $int = res.interes[$var].noventa ;
                }else if($plazo == 180){
                    $plazoStr = "180 días";
                    $int = res.interes[$var].ciento_ochenta;
                }else if($plazo == 'un_ano'){
                    $plazoStr = "1 año";
                    $int = res.interes[$var].un_ano;
                }else if($plazo == 'dos_anos'){
                    $plazoStr = "2 años";
                    $int = res.interes[$var].dos_anos;
                }else{
                    $plazoStr = "más de 2 años";
                    $int = res.interes[$var].mas_dos_anos;
                }
                $( "#body_entidades" ).append( '<tr class="text-center"><td id="banco'+serv.id_capacidad+'">'+serv.name+'</td><td id="prestamo'+serv.id_capacidad+'">'+valorcouta+'</td><td id="tasa'+serv.id_capacidad+'">'+$int+'</td><td id="plazomodal'+serv.id_capacidad+'">'+$plazoStr+'</td><td><div class="row"><div class="col"><button type="button" class="btn btn-form" onclick="application('+serv.id_capacidad+')" '+ habilitado + '>Solicitar</button></div></div></td></tr>' );
                $var= $var + 1;
            });
        }).fail((error) => {
            //alert("error, no se puede traer la información solicitada");
        });
    }
// Al mover el rango se carga la tabla
    $(document).on('input', '#monto', function() {
        $minimo = $(this).val();
        cargarTabla($minimo);
    });
    
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
    
    $( "#plazo" ).change(function() {
        $plazo = $(this).val();
        $minimo=  document.getElementById("monto").value;
        cargarTabla($minimo);
        
        
    });
    $( "#input_value" ).blur(function() {
        $minimo = $(this).val();
        cargarTabla($minimo);
    });

</script>
@endsection()
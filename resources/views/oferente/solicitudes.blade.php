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
              <th scope="col">Tasa</th>
              <th scope="col">Estado</th>
              <th scope="col">Contador Tiempo</th>
              <th scope="col">Genera Valor</th>
            </tr>
          </thead>
          <tbody class="body-admin text-center">
            @foreach($solicitud as $solicitudes)
            <tr>
                <td>{{date_format(date_create($solicitudes->fecha),"d/m/Y")}}</td>
                @if($solicitudes->estado == 'Iniciado')
                <td><a href="#" onclick="showPyme({{$solicitudes->id}})">Empresa {{$solicitudes->id}}</a></td>
                @else
                <td><a href="#" onclick="showPyme2({{$solicitudes->id}})">{{$solicitudes->empresa}}</a></td>
                @endif()
                <td>{{$solicitudes->sector}}</td>
                <td>${{number_format($solicitudes->monto)}}</td>
                <td>{{$solicitudes->tasa}}%</td>
                <td>
                <a role="button" style="font-size: 13px;" class="@if($solicitudes->estado == 'Iniciado')btn btn-info @elseif($solicitudes->estado == 'En estudio')btn btn-warning @elseif($solicitudes->estado == 'Aceptada' || $solicitudes->estado == 'Contactado') btn btn-warning @elseif($solicitudes->estado == 'Finalizado') btn btn-success @endif() " onclick="@if($solicitudes->estado != 'Rechazada' && $solicitudes->estado != 'Finalizado')  @if($solicitudes->estado == 'Aceptada') showStateAceptada({{$solicitudes->id}})  @elseif ($solicitudes->estado == 'En estudio') showStateEnestudio({{$solicitudes->id}}) @elseif ($solicitudes->estado == 'Contactado') showStateContactado({{$solicitudes->id}}) @else showState({{$solicitudes->id}}) @endif   @endif" href="#">@if($solicitudes->estado == 'Finalizado') Desembolsado @else {{$solicitudes->estado}} @endif()<i class="far fa-edit fa-sm"></i></a>
                </td>
                <td id="demo{{$solicitudes->id}}"></td>
                <td>
                @if($solicitudes->roic > $solicitudes->wacc)
                    Si
                @else
                    No
                @endif()
                </td>
            </tr>
            @endforeach()
          </tbody>
        </table>
    </div>
</div>
<!-- modal1 -->
<div class="modal fade" id="modal_estado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
            <div class="col text-center" >
                <h3> Cambiar estado</h3>
            </div>
        </div>
        <div class="row mb-5 mt-3">
            <div class="col" align="center">
            <form action="" id="form_estado" >
            <input type="text" hidden id="id_aplicacion" name="id_aplicacion">
            	<select  class="custom-select"  id="estado" name="estado" required>
                    <option id="Enestudio" >En estudio</option>
                    <option id="Aceptada">Aceptada</option>
                    <option id="Rechazada">Rechazada</option>
                    <option id="Finalizado" value="Finalizado">Desembolsado</option>
                    <option id="Contactado">Contactado</option>
                </select>
            </form>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="changeState()">Guardar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<!-- modal2 -->
<div class="modal fade" id="modal_estado2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col text-center" >
                        <h3> Cambiar estado</h3>
                    </div>
                </div>
                <div class="row mb-5 mt-3">
                    <div class="col" align="center">
                        <form action="" id="form_estado2" >
                            <input type="text" hidden id="id_aplicacion2" name="id_aplicacion2">
                            <select  class="custom-select"  id="estado2" name="estado2" required>
                                <option id="Finalizado2">Desembolsado</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="changeState2()">Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<!-- modal -->
<!-- modal -->
<div class="modal" tabindex="-1" role="dialog" id="modal_pyme">
    <div class="modal-dialog" role="document">

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Información de la simulación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
             <div class="col-lg-12">
                  <div class="row">
                      <div class="col-lg-8">
                          <p>Ingresos :</p>
                      </div>
                      <div class="col-lg-4">
                          <p id="income" class="income"></p>
                      </div>
                  </div>
                  <div class="row ">
                      <div class="col-lg-8">
                          <p>Costos de ventas :</p>
                      </div>
                      <div class="col-lg-4">
                          <p id="sale_value" class="sale_value"></p>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-lg-8">
                          <p>Gastos de operación :</p>
                      </div>
                      <div class="col-lg-4">
                          <p id="operating_costs" class="operating_costs"></p>
                      </div>
                  </div>
                  <div class="row ">
                      <div class="col-lg-8">
                          <p>Gastos de depreciación :</p>
                      </div>
                      <div class="col-lg-4">
                          <p id="depreciation_costs" class="depreciation_costs"></p>
                      </div>
                  </div>
                  <div class="row ">
                      <div class="col-lg-8">
                          <p>Gastos de amortización :</p>
                      </div>
                      <div class="col-lg-4">
                          <p id="amortization_costs" class="amortization_costs"></p>
                      </div>
                  </div>
                  <div class="row ">
                      <div class="col-lg-8">
                          <p>Saldo de obligaciones financieras :</p>
                      </div>
                      <div class="col-lg-4">
                          <p id="financial_obligations" class="financial_obligations"></p>
                      </div>
                  </div>
                  <div class="row ">
                      <div class="col-lg-8">
                          <p>Valor del Patrimonio :</p>
                      </div>
                      <div class="col-lg-4">
                          <p id="heritage_value" class="heritage_value"></p>
                      </div>
                  </div>
{{--                 <div class="row ">--}}
{{--                     <div class="col-lg-8">--}}
{{--                         <p>Ebitda :</p>--}}
{{--                     </div>--}}
{{--                     <div class="col-lg-4">--}}
{{--                         <p id="ebitda" class="heritage_value"></p>--}}
{{--                     </div>--}}
{{--                 </div>--}}
{{--                 <div class="row ">--}}
{{--                     <div class="col-lg-8">--}}
{{--                         <p>EBITDA/Gastos por Intereses :</p>--}}
{{--                     </div>--}}
{{--                     <div class="col-lg-4">--}}
{{--                         <p id="covenant1" class="covenant1"></p>--}}
{{--                     </div>--}}
{{--                 </div>--}}
{{--                 <div class="row ">--}}
{{--                     <div class="col-lg-8">--}}
{{--                         <p>Obligaciones financieras / EBITDA :</p>--}}
{{--                     </div>--}}
{{--                     <div class="col-lg-4">--}}
{{--                         <p id="covenant2" class="covenant2"></p>--}}
{{--                     </div>--}}
{{--                 </div>--}}
{{--                 <div class="row ">--}}
{{--                     <div class="col-lg-8">--}}
{{--                         <p>Obligaciones financieras / financiación total :</p>--}}
{{--                     </div>--}}
{{--                     <div class="col-lg-4">--}}
{{--                         <p id="covenant3" class="covenant3"></p>--}}
{{--                     </div>--}}
{{--                 </div>--}}
              </div>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- modal -->
<div class="modal" tabindex="-1" role="dialog" id="modal_pyme2">

    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Información de la simulación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="row">
                            <div class="col-lg-8">
                                <p>Nit :</p>
                            </div>
                            <div class="col-lg-4">
                                <p id="nit" class="nit"></p>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-lg-8">
                                <p>Nombre de compañia :</p>
                            </div>
                            <div class="col-lg-4">
                                <p id="name_company" class="name_company"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <p>Nombre de contacto :</p>
                            </div>
                            <div class="col-lg-4">
                                <p id="name_contact" class="name_contact"></p>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-lg-8">
                                <p>Numero de contacto :</p>
                            </div>
                            <div class="col-lg-4">
                                <p id="phone" class="phone"></p>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-lg-8">
                                <p>Ubicacion :</p>
                            </div>
                            <div class="col-lg-4">
                                <p id="ubication" class="ubication"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="row">
                            <div class="col-lg-8">
                                <p>Ingresos :</p>
                            </div>
                            <div class="col-lg-4">
                                <p id="income2" class="income"></p>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-lg-8">
                                <p>Costos de ventas :</p>
                            </div>
                            <div class="col-lg-4">
                                <p id="sale_value2" class="sale_value"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <p>Gastos de operación :</p>
                            </div>
                            <div class="col-lg-4">
                                <p id="operating_costs2" class="operating_costs"></p>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-lg-8">
                                <p>Gastos de depreciación :</p>
                            </div>
                            <div class="col-lg-4">
                                <p id="depreciation_costs2" class="depreciation_costs"></p>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-lg-8">
                                <p>Gastos de amortización :</p>
                            </div>
                            <div class="col-lg-4">
                                <p id="amortization_costs2" class="amortization_costs"></p>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-lg-8">
                                <p>Saldo de obligaciones financieras :</p>
                            </div>
                            <div class="col-lg-4">
                                <p id="financial_obligations2" class="financial_obligations"></p>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-lg-8">
                                <p>Valor del Patrimonio :</p>
                            </div>
                            <div class="col-lg-4">
                                <p id="heritage_value2" class="heritage_value"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                    </div>
                    <div class="col-lg-6">
                        <div class="row ">
                            <div class="col-lg-8">
                                <p>Ebitda:</p>
                            </div>
                            <div class="col-lg-4">
                                <p id="ebitda" class="ebitda"></p>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-lg-8">
                                <p>CEC:</p>
                            </div>
                            <div class="col-lg-4">
                                <p id="covenant1" class="covenant1"></p>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-lg-8">
                                <p>CECC:</p>
                            </div>
                            <div class="col-lg-4">
                                <p id="covenant2" class="covenant2"></p>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-lg-8">
                                <p>CES:</p>
                            </div>
                            <div class="col-lg-4">
                                <p id="covenant3" class="covenant3"></p>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-lg-8">
                                <p>CEA:</p>
                            </div>
                            <div class="col-lg-4">
                                <p id="covenant4" class="covenant4"></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endsection()
@section('script')
<script>
    var urlChangeState = "{{url('changestate')}}";
    var urlShowPyme = "{{url('showpyme')}}/";
    var x = setInterval(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "get",
            url: "{{url('showtime')}}",
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
                if (document.getElementById("demo"+serv.id) !== null){
                document.getElementById("demo"+serv.id).innerHTML = days + "d " + hours + "h "
                + minutes + "m " + seconds + "s ";
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
            
        }).fail((error) => {
            //Si la repuesta al controlador no es correcta, se muestra un modal con el error.
        });
    }, 1000);
</script>

@endsection()




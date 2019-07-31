@extends('layouts.app')
@section('content')
<nav class="admin-nav">
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Sectores</a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Costo Patrimonio   </a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <div class="row m-0">
            <div class="col">
                <table class="table table-striped bg-white" id="patrimonio_tableadmin">
                    <thead class="thead ">
                        <tr class="head-table text-center">
                            <th scope="col">Sector</th>
                            <th scope="col">Beta desapalancado</th>
                            <th scope="col">Cambiar</th>
                        </tr>
                    </thead>
                    <tbody class="body-admin text-center">
                        @foreach($sector as $sectores)
                        <tr>
                            <td>{{$sectores->name}}</td>
                            <td>{{$sectores->beta_desapalancado}}</td>
                            <td> <button href="#" class="btn btn-info" id="edit_btn_beta" onclick="activeEditBeta({{$sectores->id}})">Editar</button></td>
                        </tr>
                        @endforeach()
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col editar-costo">
                <div class="row mt-5 ">
                    <div class="btn-group mr-2 ml-3" role="group" >
                        <button href="#" class="btn btn-success"  data-toggle="modal" data-target="#modal_detalle">Ver detalle</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade patrimonio-form" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
        <form action="" id="form_patrimonio">
            <div class="row m-0 mb-3 mt-5">
                <div class="col">
                    Tasa Libre de Riesgo USA
                </div>
                <div class="input-group col">
                    <input type="text" class="form-control " id="input-tasalibre" name="tlr_usa" disabled>
                    <div class="input-group-append">
                        <span class="input-group-text">%</span>
                    </div>
                </div>
                <div class="col">
                    <p>Riesgo País (EMBI)</p>
                </div>
                <div class="input-group col">
                    <input type="text" class="form-control " id="input-EMBI" name="embi" disabled>
                    <div class="input-group-append">
                        <span class="input-group-text">%</span>
                    </div>
                </div>
            </div>
            <div class="row m-0 mb-3">
                <div class="col">
                    <p>Tasa de Impuestos</p>
                </div>
                <div class="input-group col">
                    <input type="text" class="form-control " id="input-tasa_impuestos" name="tasa_impuestos" disabled>
                    <div class="input-group-append">
                        <span class="input-group-text">%</span>
                    </div>
                </div>
                <div class="col">
                    <p>Prima de Mercado</p>
                </div>
               <div class="input-group col">
                    <input type="text" class="form-control " id="input-prima_mercado" name="prima_mercado" disabled>
                    <div class="input-group-append">
                        <span class="input-group-text">%</span>
                    </div>
                </div>
            </div>
            <div class="row  mb-3">
                <div class="col">
                    <p>Inflación Colombia</p>
                </div>
                <div class="input-group col">
                    <input type="text" class="form-control " id="input-inflacion_colombia" name="inflacion_colombia" disabled>
                    <div class="input-group-append">
                        <span class="input-group-text">%</span>
                    </div>
                </div>
                <div class="col">
                    <p>Inflación Usa</p>
                </div>
                <div class="input-group col">
                    <input type="text" class="form-control " id="input-inflacion_usa" name="inflacion_usa" disabled>
                    <div class="input-group-append">
                        <span class="input-group-text">%</span>
                    </div>
                </div>
            </div>
        </form>
        <div class="row mt-5 ">
            <div class="btn-group mr-2 ml-3" role="group" >
                <button href="#" class="btn btn-info" id="edit_btn" onclick="activeEditPatrimonio()">Editar</button>
            </div>
            <div class="btn-group mr-2" role="group" >
                <a class="btn btn-warning"  id="save_btn" >Guardar</a>
            </div>
            <div class="btn-group " role="group" >
                <a href="{{url('/costo_patrimonio')}}" class="btn btn-danger" id="cancel_btn">Cancelar</a>
            </div>
        </div>
        
    </div>
</div>
<!-- modal -->
<div class="modal" tabindex="-1" role="dialog" id="modal_detalle">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detalle Beta Desapalancado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="row mt-4">
                <div class="col">
                    <table id="table-detalle" class="table table-striped bg-white" style="width:100%">
                        <thead class="head-table text-center">
                            <th scope="col">Agricultura</th>
                            <th scope="col">Explotacion</th>
                            <th scope="col">Industria</th>
                            <th scope="col">Electricidad</th>
                            <th scope="col">Agua</th>
                            <th scope="col">Construccion</th>
                            <th scope="col">Comercio</th>
                            <th scope="col">Transporte</th>
                            <th scope="col">Alojamiento</th>
                            <th scope="col">Comunicaciones</th>
                            <th scope="col">Financieras</th>
                            <th scope="col">Inmobiliarias</th>
                            <th scope="col">Cientificas</th>
                            <th scope="col">Administrativos</th>
                            <th scope="col">Publica</th>
                            <th scope="col">Educacion</th>
                            <th scope="col">Salud</th>
                            <th scope="col">Arte</th>
                            <th scope="col">Otras</th>
                            <th scope="col">Hogares</th>
                            <th scope="col">Organizaciones</th>
                            <th scope="col">No incluidas</th>
                        </thead>
                        <tbody class="body-admin text-center">
                            <tr>
                            @foreach($sector as $sectores )
                                <td>{{$sectores->beta_desapalancado}}</td>
                            @endforeach()
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection()
@section('script')
    <script>
    $(document).ready(function () {
        $('#save_btn').hide();                
        $('#cancel_btn').hide(); 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); 
        $.ajax({
            method: "GET",
            url: "/getcostopatrimonio/"
        }).done((res) => {
            document.getElementById("input-tasalibre").value= res.tlr_usa ;
            document.getElementById("input-EMBI").value= res.embi ;
            document.getElementById("input-tasa_impuestos").value= res.tasa_impuestos ;
            document.getElementById("input-prima_mercado").value= res.prima_mercado ;
            document.getElementById("input-inflacion_colombia").value= res.inflacion_colombia ;
            document.getElementById("input-inflacion_usa").value= res.inflacion_usa ;
            var save = document.getElementById('save_btn');
            save.setAttribute('onclick', 'editCostoPatrimonio('+ res.id+')' );

        }).fail((error) => {
                alert("error, no se puede traer la información solicitada");
        });

    });

    </script>
@endsection()




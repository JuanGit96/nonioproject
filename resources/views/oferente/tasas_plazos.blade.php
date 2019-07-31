@extends('layouts.app')
@section('content')
<div class="row m-0">
    <div class="ml-4 mt-4">
        <div class="bg-light text-white">
            <h4 class="mb-0 p-2">Tasas de interés</h4>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col ">
        <form action="" id="form_tasas">
            <div class="row m-0">
                <div class="col text-center">
                    <p>90 DÍAS</p>
                    <input type="text"  class="form-control" disabled id="90" name="noventa">
                </div>
                <div class="col text-center">
                    <p>180 DÍAS</p>
                    <input type="text"  class="form-control" disabled id="180" name="ciento_ochenta">
                </div>
                <div class="col text-center">
                    <p>1 AÑO</p>
                    <input type="text"  class="form-control" disabled id="un_ano" name="un_ano">
                </div>
                <div class="col text-center">
                    <p>2 AÑOS</p>
                    <input type="text"  class="form-control" disabled id="dos_anos" name="dos_anos">
                </div>
                <div class="col text-center">
                    <p>MÁS DE 2 AÑOS</p>
                    <input type="text"  class="form-control" disabled id="mas_dos_anos" name="mas_dos_anos">
                </div>
            </div>
            <div class="row mt-3 pl-3 mb-4">
                <div class="btn-group mr-2" role="group" >
                    <button href="#" class="btn btn-info" id="edit_btn_tasas" onclick="activeEditTasas();return false;">Editar</button>
                </div>
                <div class="btn-group mr-2" role="group" >
                    <a class="btn btn-warning"  id="save_btn_tasas" onclick="guardartasas()">Guardar</a>
                </div>
                <div class="btn-group mr-2" role="group" >
                    <a href="{{url('/tasas_plazos')}}" role="button" class="btn btn-danger" id="cancel_btn_tasas">Cancelar</a>
                </div>
                <div class="alert-info pl-1 pr-1">
                    <i class="fa fa-info-circle"></i>
                    Edita desde esta seccion si deseas aplicar las mismas tasas a todos los sectores
                </div>
            </div>
        </form>
    </div>
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
                            <th scope="col">90</th>
                            <th scope="col">180</th>
                            <th scope="col">1 AÑO</th>
                            <th scope="col">2 AÑOS</th>
                            <th scope="col">MÁS DE 2 AÑOS</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody class="body-admin text-center">
                        @foreach($Interest as $Interest)
                        @if($Interest->state == "No")
                        <tr>

                            <td><?php
                                $sectores = $offers = DB::table('sectors')->where('id', $Interest->sector_id)->first();
                                echo $sectores->name;
                                ?>
                            </td>
                            <td>{{$Interest->noventa}}%</td>
                            <td>{{$Interest->ciento_ochenta}}%</td>
                            <td>{{$Interest->un_ano}}%</td>
                            <td>{{$Interest->dos_anos}}%</td>
                            <td>{{$Interest->mas_dos_anos}}%</td>

                            <td> 
                                <button href="#" class="btn btn-info" data-toggle="modal" data-target="#modal_detalle" data-toggle="tooltip" title="Editar" id="edit_btn_beta" onclick="tasasyplazos({{$Interest->id}} ,'{{ route('tasasyplazos',$Interest->id)}}')">Editar</button>
                                <button class="btn btn-danger" data-toggle="tooltip" title="Vetar" onclick="Betar({{$Interest->id}})">Vetar</button>
                            </td>
                        </tr>
                        @else()
                        <tr  style="background-color: #fb9692; ">

                            <td><?php
                                $sectores = $offers = DB::table('sectors')->where('id', $Interest->sector_id)->first();
                                echo $sectores->name;
                                ?>
                            </td>
                            <td>{{$Interest->noventa}}%</td>
                            <td>{{$Interest->ciento_ochenta}}%</td>
                            <td>{{$Interest->un_ano}}%</td>
                            <td>{{$Interest->dos_anos}}%</td>
                            <td>{{$Interest->mas_dos_anos}}%</td>
                            <td> 
                                <button class="btn btn-success" data-toggle="tooltip" title="Habilitar" onclick="HabilitarSector({{$Interest->id}})">Habilitar</button>
                            </td>
                        </tr>
                        @endif()
                        @endforeach()
                    </tbody>
                </table>
                <div class="alert-info pl-1 pr-1 col-md-6 float-right">
                    <i class="fa fa-info-circle"></i>
                    Edita desde la tabla si deseas establecer tasas por sector
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
<div class="modal" tabindex="-1" role="dialog" id="modal_detalle" aria-hidden="true" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Tasa</h5>
            </div>
            <div class="modal-body">
                <form   method="post" id="formedittasas">   
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">90</label>
                        <div class="col-md-6">
                            <input type="text"  class="form-control" name="noventa" id="noventa" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="select">180</label>
                        <div class="col-md-6">
                            <input type="text"  class="form-control" name="ciento_ochenta" id="ciento_ochenta" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="select">1 AÑO</label>
                        <div class="col-md-6">
                            <input type="text"  class="form-control" name="interes" id="interes" hidden>
                            <input type="text"  class="form-control" name="un_ano" id="un_ano1" required>
                        </div>
                    </div>
                    <div class="form-group row" id="obdiv">
                        <label class="col-md-3 form-control-label" for="text-input">2 AÑOS</label>
                        <div class="col-md-6">
                            <input type="text"  class="form-control" name="dos_anos" id="dos_anos1" required>
                        </div>
                    </div>
                    <div class="form-group row" id="obdiv">
                        <label class="col-md-3 form-control-label" for="text-input">MÁS DE 2 AÑOS</label>
                        <div class="col-md-6">
                            <input type="text"  class="form-control" name="mas_dos_anos" id="mas_dos_anos1" required>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="updatetasainteres()" class="btn-sm btn-info">
                    <i class="fa fa-dot-circle-o"></i> Guardar</button>
                <a class="btn-sm btn-danger" data-dismiss="modal">
                    <i class="fa fa-ban"></i> Cancelar
                </a>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection()
@section('script')
<script>
    var urlUpdatetasas = "{{url('/updatetasainteres')}}/";
    var urlVetar = "{{url('/Betar')}}/";
    var urlHabilitar = "{{url('/Habilitar')}}/";
    $(document).ready(function () {
    $('#save_btn_tasas').hide();
    $('#cancel_btn_tasas').hide();
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
        method: "GET",
            url: "{{url('/tasasyplazos')}}/" + 1
    }).done((res) => {
    console.log(res);
    $("#1").addClass("active");
    document.getElementById("90").value = res.noventa;
    document.getElementById("180").value = res.ciento_ochenta;
    document.getElementById("un_ano").value = res.un_ano;
    document.getElementById("dos_anos").value = res.dos_anos;
    document.getElementById("mas_dos_anos").value = res.mas_dos_anos;
    //document.getElementById("vetar_sector").value = res.state;
    var save = document.getElementById('save_btn_tasas');
    save.setAttribute('onclick', 'editTasas(' + res.id + ')');
    }).fail((error) => {
    alert("error, 1 no se puede traer la información solicitada");
    });
    });
    function getTasas(id) {

    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
    method: "GET",
            url: "{{url('/tasasyplazos')}}/" + id
    }).done((res) => {
    document.getElementById("90").value = res.noventa;
    document.getElementById("180").value = res.ciento_ochenta;
    document.getElementById("un_ano").value = res.un_ano;
    document.getElementById("dos_anos").value = res.dos_anos;
    document.getElementById("mas_dos_anos").value = res.mas_dos_anos;
    //document.getElementById("vetar_sector").value = res.state;
    var save = document.getElementById('save_btn_tasas');
    save.setAttribute('onclick', 'editTasas(' + res.id + ')');
    }).fail((error) => {
    alert("error, 2 no se puede traer la información solicitada");
    });
    }

</script>
@endsection()


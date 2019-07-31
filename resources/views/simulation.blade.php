@extends('layouts.app')
@section('content')

<section id="clients" class="infocolumn">
    <div class="row">
        <!-- Imagen -->
        <div class="col-lg-4 d-none d-xl-block d-lg-block d-md-block p-0">
            <img src="{{asset('img/imgformpro.png')}}" alt="" width="100%" height="100%" >
        </div>
        <!-- Seccion formulario -->
        <div class="formulario col-lg-8 pr-3 pb-5">
            <div class="row mt-5 ">
                <div class="col"align="center">
                    <p >En el siguiente formulario ingresa la información actual de tu empresa para estimar tu capacidad de endeudamiento. </p>
                    <p>No olvides incluir los datos del último cierre anual en pesos</p>
                </div>
            </div>
            <div class="row ">
                <div class=" formcont col">
                    @if($errors->any())<!--Si tenemos algun error-->
                        <div class="alert alert-danger">
                            <h5>Porfavor corrige los errores</h5>
                            <ul>
                                {{--@foreach($errors->all() as $error)--}}
                                    <li>Todos los campos son OLIGATORIOS</li>
                                {{--@endforeach--}}
                            </ul>
                        </div>
                    @endif
                    <form action="{{ action('SimulationController@createSimulation') }}" method="post"  enctype="multipart/form-data" id="formSimulation">
                        {{ csrf_field() }}
                        <div class="form-row">
                            <div class="col-lg-6 col-sm-12 col-md-12 ">
                                <label  class="form-control-label" >Sector al que pertenece tu empresa </label>
                                <select  class="custom-select"  name="sector" required>
                                    <option value="">Escoge un sector</option>
                                    @foreach($sector as $sectores)
                                    <option value="{{$sectores->id}}">{{$sectores->name}}</option>
                                    @endforeach()
                                </select>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-12  ">
                                <label  class="form-control-label" for="date">Fecha de la información financiera</label>
                                <button type="button" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="top" data-html="true" title="<div align='left'>Introduce fecha de año fiscal de la información financiera.</div>" >
                                    <span class="fas fa-question"></span> 
                                </button>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><span class="input-group-addon add-on"><span class="fas fa-calendar-alt"></span></span></div>
                                    </div>
                                    <select name="date" id="date" class="custom-select" required>
                                        <option value="" selected >Selecciona la fecha</option>
                                        <option value="2016">2016</option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="form-row pt-4">
                            <div class="col-lg-6 col-sm-12 col-md-12  ">
                                <label  class="form-control-label" for="income">Ingresos</label>
                                <button type="button" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="top" title="Remuneración producto de la actividad económica de la empresa">
                                    <span class="fas fa-question"></span> 
                                </button>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon3">COP</span>
                                    <input type="text"  class="form-control" name="income" required id="income"  placeholder="$">
                                    <div class="income-error invalid-feedback" >Debe ser mayor a  1'000.000  </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-12  ">
                                <label  class="form-control-label" for="sale_value">Costos de ventas</label>
                                <button type="button" class="btn btn-warning btn-circle"  data-toggle="tooltip" data-placement="top" title="Costo de las actividades o de los bienes asociados a los Ingresos Operacionales">
                                    <span class="fas fa-question"></span> 
                                </button>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon3">COP</span>
                                    <input name="sale_value" id="sale_value" class="form-control" type="text" required placeholder="$">
                                </div>
                            </div>
                        </div>
                        <div class="form-row pt-4">
                            <div class="col-lg-6 col-sm-12 col-md-12 ">
                                <label  class="form-control-label" for="operating_costs">Gastos de operación (Administración y ventas)</label>
                                <button type="button" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="top" title="Gastos de Administración y de ventas en los que incurre la empresa para poder desarrollar suu actividades" >
                                    <span class="fas fa-question"></span> 
                                </button>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon3">COP</span>
                                    <input   name="operating_costs" id="operating_costs" type="text" class="form-control" required placeholder="$">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-12  ">
                                <label  class="form-control-label" for="depreciation_costs">Gastos de depreciación</label>
                                <button type="button" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="top" title="Reconocimiento del uso o deterioro de los Activos Fijos utilizados en el desarrollo del objeto social" >
                                    <span class="fas fa-question"></span> 
                                </button>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon3">COP</span>
                                    <input   name="depreciation_costs" id="depreciation_costs" type="text" class="form-control" required placeholder="$">
                                </div>
                            </div>
                        </div>
                        <div class="form-row pt-4">
                            <div class="col-lg-6 col-sm-12 col-md-12  ">
                                <label  class="form-control-label" for="amortization_costs">Gastos de armortización</label>
                                <button type="button" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="top" title="Reducción del valor de los activos Intangibles y/o Diferidos por la perdida de valor o por el proceso de distribución del gasto en el tiempo" >
                                    <span class="fas fa-question"></span> 
                                </button>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon3">COP</span>
                                    <input   name="amortization_costs" id="amortization_costs" type="text" class="form-control" required placeholder="$">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-12  ">
                                <label  class="form-control-label" for="financial_obligations">Saldo de obligaciones financieras</label>
                                <button type="button" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="top" title="Acreencias de la empresa asociadas al costo del dinero en el tiempo con Entidades Financieras, Terceros o Accionistas." >
                                    <span class="fas fa-question"></span> 
                                </button>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon3">COP</span>
                                    <input type="text"  name="financial_obligations" id="financial_obligations"  class="form-control" required placeholder="$">
                                </div>
                            </div>
                        </div>
                        <div class="form-row pt-4 mb-4">
                            <div class="col-lg-6 col-sm-12 col-md-12  ">
                                <label  class="form-control-label" for="heritage_value">Valor del Patrimonio</label>
                                <button type="button" class="btn btn-warning btn-circle"  data-toggle="tooltip" data-placement="top" title="Conjunto de bienes, derechos y obligaciones de una empresa en un instante en el tiempo, es decir la diferencia existente entre Activos y Pasivos.">
                                    <span class="fas fa-question"></span> 
                                </button>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon3">COP</span>
                                    <input   name="heritage_value" id="heritage_value" type="text" class="form-control" required placeholder="$">
                                    <div class="heritage_value-error invalid-feedback" >Debe ser mayor a  1'000.000  </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-12 ">
                                <label  class="form-control-label" for="email_contact">Ingresa e-mail de contacto </label>
                                <button type="button" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="top" title="Este correo sera utilizado para crear un usuario en la plataforma">
                                    <span class="fas fa-question"></span> 
                                </button>
                                <input type="email" class="form-control" name="email_contact" type="text" id="email_contact">
                                <div class="email-error invalid-feedback" >El correo ya se encuentra registrado  </div>
                            </div>

                        </div>
                        <br>
                        {{--<div class="form-row">--}}
                            {{--<div class="col-lg-5">--}}
                                {{--<label  class="form-control-label" for="customFile">Información adicional de tu empresa :</label>--}}
                                {{--<button type="button" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="top" title="Archivo disponible para cargar al sistema sobre tu empresa	">--}}
                                    {{--<span class="fas fa-question"></span>--}}
                                {{--</button>--}}
                                {{--<div class="form-group ">--}}
                                    {{--<div class=" punteado pl-1">--}}
                                        {{--<input type="file" class="form-control-file" id="file" name="file">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        <div class="text-center mb-3">  
                            <input type="button" value="Aceptar" id="simulationSubmit" class="btn btn-form">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- fin seccion -->


@endsection()
@section('script')
<script>
    var urlValidateEmail = "{{url('/validateEmail')}}";
</script>
@endsection()
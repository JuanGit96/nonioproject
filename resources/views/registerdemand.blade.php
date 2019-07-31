@extends('layouts.app')
@section('content')
<!-- Formulario para financieros -->
<section id="demand" >
    <div class="row">
        <div class="col-lg-5 d-none d-xl-block d-lg-block d-md-block p-0">
            <img src="{{asset('img/img-simulation.jpg')}}" alt="" width="100%">
        </div>
        <div class="col-lg-7 p-0">
            <div class="formrow row mt-lg-5">
                <div class="col" align="center">
                    <h5>Ingresa la siguiente información</h5>
                </div>
            </div>
            <div class="row">
                <div class="formsuccess col mt-5 mb-3 ml-4 mr-4"align="center">
                    <p >La información suministrada en los formularios de la plataforma estarán a disposición de las entidades de Crédito Aliadas, quiénes son los responsables de contactarte.</p>
                </div>
            </div>
            <div class="formsuccess row">
                <div class="col ml-4 mr-4">
                    <form action="{{ action('DemandController@store') }}" method="post" id="formdemand">
                        {{ csrf_field() }}
                        <div class="form-row mb-4">
                            <div class="col-lg-6">
                                <input  type="text"  value="{{$max}}" id="max" hidden>
                                <input  type="text" name="simulation_id" value="{{$simulation_id}}" id="simulation_id" hidden>
                                <input  type="text" name="user_id" value="{{$id}}" id="user_id" hidden>
                                <label class="form-control-label" for="nit" >NIT de la empresa </label>
                                <input type="text" id="nit" name="nit" class="form-control" onkeypress="return valida(event)" required>
                                <div class="nit-error invalid-feedback" >El nit de la empresa ya existe</div>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-control-label" for="name_company">Nombre de la empresa </label>
                                <input type="text" id="name_company" name="name_company" class="form-control" required>
                                <div class="name_company-error invalid-feedback" >El nombre de la empresa ya existe</div>
                            </div>
                        </div>

                        <div class="form-row mb-4">
                            <div class="col-lg-6">
                                <label class="form-control-label" for="name_contact">Nombre de la persona de contacto </label>
                                <input type="text" id="name_contact"  name="name_contact"
                                       :class="['form-control', (name_contact.clase).trim() ? 'is-'+name_contact.clase : '']" 
                                       v-model="name_contact.input"
                                       v-on:keyup="escribirLetras(name_contact)" required>
                                <div :class="(name_contact.clase.trim() ? name_contact.clase:'')+'-feedback'" v-text="name_contact.mensaje"></div>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-control-label" for="phone_contact">Teléfono de contacto </label>
                                <input type="text" id="phone_contact" name="phone_contact"
                                       :class="['form-control', (phone_contact.clase).trim() ? 'is-'+phone_contact.clase : '']" 
                                       v-model="phone_contact.input"
                                       v-on:keyup="escribir(phone_contact)" required>
                                <div :class="(phone_contact.clase.trim() ? phone_contact.clase:'')+'-feedback'" v-text="phone_contact.mensaje"></div>
                            </div>
                        </div>
                        <div class="form-row mb-4">
                            <div class="col-lg-6">
                                <label class="form-control-label" for="value_requested">Monto solicitado en millones de pesos </label>
                                <input type="text" id="value_requested" name="value_requested"  class="form-control" required placeholder="$">
                                <div class="value_requested-error invalid-feedback" >No esta dentro del rango</div>
                                <small id="passwordHelpBlock" class="form-text text-muted">
                                    El monto solicitado debe ser máximo de : <br>  $ {{ number_format($max) }}.
                                </small>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-control-label" for="ubication">Ubicación </label>
                                <input type="text" id="ubication" name="ubication"
                                       :class="['form-control', (ubication.clase).trim() ? 'is-'+ubication.clase : '']" 
                                       v-model="ubication.input"
                                       v-on:keyup="escribirLetras(ubication)" required>
                                <div :class="(ubication.clase.trim() ? ubication.clase:'')+'-feedback'" v-text="ubication.mensaje"></div>
                            </div>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                            <a href="{{url('/terminos_condiciones')}}" target="_blank">Acepto términos y condiciones</a>
                        </div>
                        <div class="text-center mt-5 mb-4">
                            <input type="button" value="Aceptar" id="demandSubmit" class="btn btn-form">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection()

@section('script')
<script>
    var urlValidateNombre = "{{url('/validateNombre')}}";
</script>
@endsection()
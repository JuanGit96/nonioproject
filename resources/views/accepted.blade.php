@extends('layouts.app')
@section('header')
    <div class="navbar-none">
    </div>
    <nav class="navbar  navbar-expand-lg navbar-menu bg-menu pt-0 pb-0">
        <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('img/Logo.png')}}" alt="" width="40%"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
@endsection()

@section('content')
    <!-- Mensaje de aceptado -->
    <section class="accepted">
        <div class="row">
            <div class="col mb-1" align="center">
                <h1>¡ Registro Exitoso !</h1>
            </div>
        </div>
        <div class="row">
            <div class="text-accepted col mt-1 mb-2 " align="center">
                <p>Según la información suministrada tienes una capacidad de endeudamiento adicional</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 " align="center"></div>
            <div class="col-lg-6 " align="center">
                <div class="row">
                    <div class="col"><p class="text-c m-0">Hasta</p></div>
                </div>
                <div class="row">
                    <div class="col"><p class="price m-0">$ {{ number_format($max) }}</p></div>
                </div>
            </div>
            <div class="col-lg-3 " align="center"></div>
        </div>

        @if(isset($edition) && $edition)
            <div class="row" style="margin-top: 10px;">
                <div class="col-lg-6 mb-3" align="center">
                    <a  href="{{route('/financiera',$id)}}">
                        <button type="button" class="btn btn-accepted" >Volver a informacion financiera</button>
                    </a>
                </div>
                <div class="col-lg-3 mb-3" align="center">
                    <a href="{{ route('get_editInfoFinanciera',$id) }}"> <button type="button" class="btn btn-accepted" >Editar de nuevo</button></a>
                </div>
                <div class="col-lg-3"></div>
            </div>
        @else
            <div class="row">
                <div class="text-accepted col mt-2 mb-2 " align="center">
                    <p class="m-0">Para continuar con el proceso ingresa información adicional de tu empresa.</p>
                    <p >¿Deseas continuar?</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-3 mb-3" align="center">
                    <button type="button" class="btn btn-accepted" data-toggle="modal" data-target="#Modal_confirmacion" >Continuar</button>
                </div>
                <div class="col-lg-3 mb-3" align="center">
                    <a href="{{ url('/') }}"> <button type="button" class="btn btn-accepted" >Ahora no</button></a>
                </div>
                <div class="col-lg-3"></div>
            </div>
        @endif

        <div class="row">
            <div class="col p-0">
                <img src="{{asset('img/felicitaciones.jpg')}}" alt="" width="100%">
            </div>
        </div>
    </section>
    <!-- Fin seccion aceptado -->
<!-- Modal Login-->
<div class="modal fade" id="Modal_confirmacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header pb-0 pt-0">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
      </div>
      <div  class="modal-body pt-0">
            <div class="row pb-4">
                <div class="col text-center">
                    <img class=""  alt="Logo" src="{{ asset('img/Logo.png') }}" width="40%">
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <p>Se creará un cuenta para que puedas iniciar sesión en la plataforma y realizar más simulaciones de crédito, revisa el correo electrónico de contacto para conocer la contraseña</p>
                </div>
            </div>
            <div class="row crear-cuenta">
                <div class="col text-center">
                    <a class="btn" role="button" href="{{ url('/user/'.$id) }}">Aceptar</a>
                </div>
            </div>
      </div>
    </div>
  </div>
</div>
@endsection()

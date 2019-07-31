@extends('layouts.app')
@section('content')
<!-- Registro de un cliente -->
<section class="success">
    <div class="row">
        <div class="col mt-4 mb-4" align="center">
            <h1>¡ Registro Éxitoso !</h1>
        </div>
    </div>
    <div class="row">
        <div class="col mt-2 mb-5" align="center">
            <img src="{{asset('img/Like.png')}}" alt="" width="15%">
        </div>
    </div>
    <div class="row">
        <div class=" col mt-1 mb-5 " align="center">
            <h5>Gracias por completar tu registro</h5>
        </div>
    </div>
    <div class="row">
        <div class="text-accepted col mb-5 " align="center">
            <h4>Nuestro esquipo iniciara la busqueda de la mejor opción financiera para tu empresa y nos estaremos comunicando contigo.</h4>
        </div>
    </div>

</section>
@endsection()

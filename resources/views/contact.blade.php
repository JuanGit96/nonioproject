@extends('layouts.app')
@section('header')
<!-- Primera parte header -->
<section>
    <nav class="navbar  navbar-expand-lg navbar-light bg-light pt-0 pb-0">
        <a class="navbar-brand d-lg-none d-xl-none " href="{{url('/')}}">Nonio</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto ">
                <li class="nav-item active pr-1">
                    <a class="nav-link"  href="{{url('/login')}}">Ingresa <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active d-lg-none d-xl-none">
                    <a class="nav-link" href="{{url('/preguntas_frecuentes')}}">Preguntas frecuentes <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active d-lg-none d-xl-none">
                    <a class="nav-link" href="{{url('/terminos_condiciones')}}">Términos y condiciones <span class="sr-only">(current)</span></a>
                </li>
            </ul>   
        </div>
    </nav>
</section>
<!-- Segunda parte del header -->
<section class="d-none d-xl-block d-lg-block ">
    <nav class="navbar  navbar-expand-lg navbar-menu bg-menu pt-0 pb-0">
        <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('img/Logo.png')}}" alt="" width="40%"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto ">
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('/preguntas_frecuentes')}}">Preguntas frecuentes |<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('/terminos_condiciones')}}">Términos y condiciones |<span class="sr-only">(current)</span></a>
                </li>
            </ul>   
        </div>
    </nav>
</section>   
@endsection()
@section('content')
<section class="container contact">
	<div class="row mt-4">
        <div class="col text-center">
            <h1> <i>Contacto</i> </h1>
        </div>
    </div>
    <div class="row mt-4 mb-5">
        <div class="col">
            <div id="map" style="height: 100%;"></div>
        </div>
        <div class="col mb-5">
            <h5>Escribenos</h5>
            <form action="">
                <p>Si tienes alguna duda o sugerencia estamos para servirte. </p>
                <div class="form-group">
                    <input type="text" class="form-control" id="" placeholder="Escribe el nombre de tu empresa" required>
                </div> 
                <div class="form-group">
                    <input type="email" class="form-control" id="" placeholder="Escribe tu correo electronico" required>
                </div>   
                <div class="form-group">
                    <textarea class="form-control" id="" rows="4" placeholder="Decribe detalladamente la duda o sugerencia que tengas" required></textarea>
                </div>
                <div class="text-right">
                    <input type="submit" value="Enviar" class="btn btn-info">
                </div>
            </form>
        </div>
    </div>
</section>
@endsection()

@section('script')
<script>
      function initMap() {
        var uluru = {lat: 4.693551, lng: -74.0581528};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 17,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxe9foMd8QS6XWglunxP2VTuxXh_gP7L0&callback=initMap"
  async defer>
</script>
@endsection()
<header class="main-header">
@if(Auth::user())
<?php 
        $role= DB::table('role_users')->where('user_id',Auth::user()->id)->first();

?>
<!-- Si el usuario es Administrador -->
@if($role->role_id == 1 || $role->role_id == 2)
<section class="header-user">
    <nav class="navbar  navbar-expand-sm navbar-light bg-light pb-0 pt-0 pr-0">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <div class="btn-group pr-2">
                        <button type="button" class="btn btn-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php $user = DB::table('offers')->where('user_id',Auth::user()->id)->first(); ?>
                            <span class="mr-2">
                            @if($user == '')
                            Administrador
                            @else
                            {{$user->name}} 
                            @endif()
                           <!--  </span><i class="fas fa-bars" style="color:white;"></i> -->
                        </button>
                      <!--   <div class="dropdown-menu dropdown-menu-right text-right">
                            <a href="{{url('/getuser')}}" role="button"  class="dropdown-item" >Perfil</a>
                            <a href="{{url('/logout')}}" role="button"  class="dropdown-item" >Cerrar Sesión</a>
                        </div> -->
                    </div>
                </li>
            </ul>   
        </div>
    </nav>
</section>
<section class="user-header d-none d-xl-block d-lg-block ">
    <nav class="navbar  navbar-expand-lg navbar-menu pt-0 pb-0">
        <a class="navbar-brand" href="#"><img src="{{asset('img/Logo.png')}}" alt="" width="40%"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
</section>
@else 
<!-- Si no es administrador -->
<section class="header-user">
    <nav class="navbar  navbar-expand-sm navbar-light bg-light pb-0 pt-0 pr-0">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <div class="btn-group pr-2">
                        <button type="button" class="btn btn-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php $name = DB::table('demands')->where('user_id',Auth::user()->id)->first(); ?>
                            <span class="mr-2">
                            @if($name=='')
                            @else
                            {{ $name->name_company}} 
                            @endif()
                            <!-- </span><i class="fas fa-bars" style="color:white;"></i> -->
                        </button>
                        <div class="dropdown-menu dropdown-menu-right text-right">
                            @if($name=='')
                            @else
                            <a href="{{url('/solicitudes/'.$name->id)}}" role="button"  class="dropdown-item" >Solicitudes</a>
                            @endif()
                            <a href="{{url('/getuser')}}" role="button"  class="dropdown-item" >Perfil</a>
                            <a href="{{url('/logout')}}" role="button"  class="dropdown-item" >Cerrar Sesión</a>
                        </div>
                    </div>
                </li>
            </ul>   
        </div>
    </nav>
</section>
<section class="user-header d-none d-xl-block d-lg-block ">
    <nav class="navbar  navbar-expand-lg navbar-menu bg-menu pt-0 pb-0">
        <a class="navbar-brand" href="#"><img src="{{asset('img/Logo.png')}}" alt="" width="40%"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
</section>
@endif()
@else

<!-- Primera parte header Principal-->
<section>
    <nav class="navbar  navbar-expand-lg navbar-light bg-light pt-0 pb-0">
        <a class="navbar-brand d-lg-none d-xl-none " href="{{url('/')}}">Nonio</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto ">
                <li class="nav-item active pr-1">
                    <a class="nav-link"  href="{{url('/login')}}">Iniciar Sesión <span class="sr-only">(current)</span></a>
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
        <a class="navbar-brand p-0" href="{{url('/')}}"><img src="{{asset('img/Logo.png')}}" alt="" width="50%"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto " id="navbar_horizontal">
                <li class="nav-item">
                    <a class="nav-link" href="#howworks" id="btnhowworks">¿Cómo funciona?<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#whoare" id="btnwhoare">¿Quiénes somos?<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#howdo" id="btnhowdo">¿Cuál es nuestro valor agregado?<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/preguntas_frecuentes')}}">Preguntas frecuentes<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/terminos_condiciones')}}">Términos y condiciones<span class="sr-only">(current)</span></a>
                </li>
            </ul>   
        </div>
    </nav>
</section>
@endif()

</header>

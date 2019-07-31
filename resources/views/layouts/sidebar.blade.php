
@if(Auth::user())
  <?php 
          
  $user = DB::table('role_users')->where('user_id',Auth::user()->id)->first();
  ?>
  @if($user->role_id == 1)
  <div class="vertical-menu pt-4">
    <a href="{{url('/getuser')}}" class ="{{ Request::is('home')||Request::is('getuser') ? 'active' : '' }} pl-5 " >Perfil</a>
    <a href="{{url('/costo_patrimonio')}}" class ="{{ Request::is('costo_patrimonio') ? 'active' : '' }} pl-5">Costo Patrimonio</a>
    <a href="{{url('/costo_deuda')}}" class ="{{ Request::is('costo_deuda') ? 'active' : '' }} pl-5">Costo Deuda</a>
    <a href="{{url('/solicitudesAdmin')}}" class ="{{ Request::is('solicitudesAdmin') ? 'active' : '' }} pl-5">Solicitudes</a>
    <a href="{{url('/EntidadesFinancieras')}}" class ="{{ Request::is('EntidadesFinancieras') ? 'active' : '' }} pl-5">Entidades Financieras</a>
      <ul class="navbar-nav  pl-4">
          <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Inscritos <span class="caret"></span></a>
              <ul class="dropdown-menu">
                  <li><a href="{{url('/inscritosUsers')}}" class ="{{ Request::is('inscritosUsers') ? 'active' : '' }} pl-5">Usuarios</a></li>
                  <li><a href="{{url('/inscritosOffers')}}" class ="{{ Request::is('inscritosOffers') ? 'active' : '' }} pl-5">Bancos</a></li>
                  <li><a href="{{url('/inscritosEmpresas')}}" class ="{{ Request::is('inscritosEmpresas') ? 'active' : '' }} pl-5">Empresas</a></li>
              </ul>
          </li>
      </ul>
    <a href="{{url('/logout')}}" class =" pl-5 mt-5">Cerrar Sesión</a>
  </div>
  @elseif($user->role_id == 2 )
  <div class="vertical-menu pt-2">
    <a href="{{url('/getuser')}}" class ="{{ Request::is('home')|| Request::is('getuser') ? 'active' : '' }} pl-3">Perfil</a>
    <a href="{{url('/covenants')}}" class ="{{ Request::is('covenants') ? 'active' : '' }} pl-5">Covenants</a>
    <a href="{{url('/tasas_plazos')}}" class ="{{ Request::is('tasas_plazos') ? 'active' : '' }} pl-5">Tasas y Plazos</a>
    <a href="{{url('/solicitudes_ofer')}}" class =" {{ Request::is('solicitudes_ofer') ? 'active' : '' }} pl-5">Solicitudes</a>
    <a href="{{url('/historial_ofer')}}" class = "{{ Request::is('historial_ofer') ? 'active' : '' }} pl-5">Historial</a>
    <ul class="navbar-nav  pl-4">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Usuarios <span class="caret"></span></a>
          <ul class="dropdown-menu">
             <li><a href="{{url('/createUser')}}" class ="{{ Request::is('CrearUsuario') ? 'active' : '' }} pl-5">Crear Usuarios</a></li>
              <li><a href="{{url('/users')}}" class ="{{ Request::is('Usuarios') ? 'active' : '' }} pl-5">Mis usuarios</a></li>
          </ul>
        </li>
    </ul>
    <a href="{{url('/logout')}}" class ="pl-5 mt-2">Cerrar Sesión</a>

  </div>
   @elseif($user->role_id == 3)
   <?php $name = DB::table('demands')->where('user_id',Auth::user()->id)->first();
   $simulation =  DB::table('simulation_demands')->where('demand_id',$name->id)->first();
    ?>

  <div class="vertical-menu pt-4">
    <a href="{{url('/getuser')}}" class ="{{ Request::is('home')|| Request::is('getuser') ? 'active' : '' }} pl-5">Perfil</a>
    <a href="{{url('/financiera/'.$simulation->simulation_id)}}" class ="{{ Request::is('financiera/*') ? 'active' : '' }} pl-5">Información Financiera</a>
     <a href="{{url('/marketplace/'.$simulation->simulation_id)}}" class ="{{ Request::is('marketplace/*') ? 'active' : '' }} pl-5">Opciones de Financiamiento</a>
    <a href="{{url('/solicitud/'.$name->id)}}" class ="{{ Request::is('solicitud/*') ? 'active' : '' }} pl-5">Mi Solicitud</a>
    <a href="{{url('/solicitudes/'.$name->id)}}" class = "{{ Request::is('solicitudes/*') ? 'active' : '' }} pl-5">Historial</a>
    <a href="{{url('/logout')}}" class ="pl-5 mt-1">Cerrar Sesión</a>
  </div>
   @elseif($user->role_id == 4 )
  <div class="vertical-menu pt-4">
    <a href="{{url('/getuser')}}" class ="{{ Request::is('home')|| Request::is('getuser') ? 'active' : '' }} pl-5">Perfil</a>
    <a href="{{url('/solicitudes_ofer')}}" class =" {{ Request::is('solicitudes_ofer') ? 'active' : '' }} pl-5">Solicitudes</a>
    <a href="{{url('/historial_ofer')}}" class = "{{ Request::is('historial_ofer') ? 'active' : '' }} pl-5">Historial</a>
    <a href="{{url('/logout')}}" class ="pl-5 mt-2">Cerrar Sesión</a>
  </div>
  @endif()

@endif()
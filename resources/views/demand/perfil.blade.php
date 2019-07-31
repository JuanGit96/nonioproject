@extends('layouts.app')
@section('content')
<section style=" height: 78vh;">
    <div class="row m-0 mb-4">
        <div class="col text-center mt-2">
            <h1>Mi Perfil</h1>
        </div>
    </div>
    <div class="row">
         <div class="col-lg-6 pl-5">
            <div class="row">
                <div class="col">
                    <h4>Datos de Usuario</h4>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p>Email :  {{$User->email}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <a href="#" class="btn btn-info" role="button" data-toggle="modal" data-target="#modal_changepass">Cambiar Contraseña</a>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col">
                    <h4>Datos Personales</h4>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p>Nit : {{$Demand->nit}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p>Nombre de compañia : {{$Demand->name_company}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p>Nombre de contacto : {{$Demand->name_contact}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p>Numero de contacto : {{$Demand->phone}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p>Ubicacion : {{$Demand->ubication}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p>Solicitudes :{{$Cant}} </p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <a   class="btn btn-info text-white" data-toggle="modal" role="button"  data-toggle="modal" data-target="#modal_editdata" onclick="editdata({{$Demand->id}} ,'{{ route('editdata',$Demand->id)}}')">
                    Editar Datos
                </a>
                </div>
            </div>
            
        </div>
    </div>
</section>
<!-- Modal Login-->
<div class="modal fade" id="modal_changepass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div  class="modal-body pt-0">
            <div class="row pb-4">
                <div class="col text-center">
                    <img class=""  alt="Logo" src="{{ asset('img/Logo.png') }}" width="40%">
                </div>
            </div>
           <form action="" class="pr-5 pl-5" id="formchangepass">
                <div class="form-group row">
                    <label class=" form-control-label" for="text-input">Actual Contraseña</label>
                        <input type="password"  name="actualpass" class="form-control"  >
                </div>
                <div class="form-group row">
                    <label class="form-control-label" for="text-input">Nueva Contraseña</label>
                        <input type="password"  name="newpass" class="form-control" >
                </div>
                <div class="form-group row">
                    <label class=" form-control-label" for="text-input">Confirmar Contraseña</label>
                        <input type="password"  name="confirmpass" class="form-control" >
                </div>
           </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info text-white"  type="button" onclick="changePass()" class="btn btn-sm btn-success" id="create-complaints" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Procesando">Guardar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal editar datos-->

<div class="modal fade" id="modal_editdata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div  class="modal-body pt-0">
            <div class="row pb-4">
                <div class="col text-center">
                    <h2 class="mt-4">Editar Datos Personales</h2>
                </div>
            </div>
           <form action="" class="pr-5 pl-5" id="formeditdemanda">
                <div class="form-group row">
                    <label class=" form-control-label" for="text-input">Nit</label>
                        <input type="text"  name="nit" id="nit" class="form-control"  >
                        <input type="text"  name="id" id="id" class="form-control"  hidden >

                </div>
                <div class="form-group row">
                    <label class="form-control-label" for="text-input">Nombre de la compañía</label>
                        <input type="text"  name="compañia"id="compañia" class="form-control" >
                </div>
                <div class="form-group row">
                    <label class=" form-control-label" for="text-input">Nombre del contacto</label>
                        <input type="text"  name="contacto" id="contacto" class="form-control" >
                </div>
                <div class="form-group row">
                    <label class=" form-control-label" for="text-input">Número del contacto</label>
                        <input type="text"  name="phone" id="phone" class="form-control" >
                </div>
                <div class="form-group row">
                    <label class=" form-control-label" for="text-input">Ubicación</label>
                        <input type="text"  name="ubication" id="ubication" class="form-control" >
                </div>
           </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info text-white" type="button" onclick="updatedata()" id="create-complaints" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Procesando">Guardar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

@endsection()

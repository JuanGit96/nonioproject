@extends('layouts.app')
@section('content')
<div class="card mt-4">
    <h5 class="card-header bg-admin text-black">Mi Perfil</h5>
    <div class="card-body">
        <div class="row">
                <div class="col-lg-6 pl-0">
                <div class="row">
                    <div class="col pl-0">
                        <h5>Datos de Usuario</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col pl-0">
                        <p>Email : {{$user->email}} </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col pl-0">
                        <a href="#" class="btn btn-info" role="button" data-toggle="modal" data-target="#modal_changepass">Cambiar Contraseña</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
        <button class="btn btn-primary"  type="button" onclick="changePass()" >Guardar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
@endsection()


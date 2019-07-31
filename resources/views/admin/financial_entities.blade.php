@extends('layouts.app')
@section('content')
<div class="row mt-4">
    <div class="col">
        <h4>Creación Entidades financieras</h4>
    </div>
</div>
<div class="row mt-4">
    <div class="col-lg-6">
        <form  id="formcreateoffer" method="post">
            <div class="form-group">
                <label for="name">Nombre de la entidad</label>
                <input type="text" class="form-control" id="name" name="name">
                <div class="name-error invalid-feedback" >El nombre ya esta registrado  </div>
            </div>
            <div class="form-group">
                <label for="name">Nombre del funcionario</label>
                <input type="text" class="form-control" id="name_functionary" name="name_functionary">
            </div>
            <div class="form-group">
                <label for="nit">Nit</label>
                <input type="text" class="form-control" id="nit" name="nit" >
                <div class="nit-error invalid-feedback" >El Nit ya esta registrado  </div>
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" id="email"  name="email">
                <div class="email-error invalid-feedback" >El correo ya esta registrado  </div>
            </div>
            <button type="button" class="btn btn-primary"  onclick="saveOffer()" id="saveOfferbtn">Guardar</button>
        </form>
    </div>
</div>

@endsection()

@section('script')
<script>
    var registerOfer = "{{url('registeroffer')}}";
    
</script>

@endsection()



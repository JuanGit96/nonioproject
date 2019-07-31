@extends('layouts.app')

@section('content')

<aside class="right-side">
  <!-- Content Header (Page header) -->
  <section class="content-header mt-2">
    <h2>
      Nuevo usuario
    </h2>
    <hr>
  </section>
  <!-- Contenido  -->
  <section class="content">
   <div class="card-body">
   @if($errors->any())<!--Si tenemos algun error-->
     <div class="alert alert-danger">
       <h5>Porfavor corrige los errores</h5>
       <ul>
         @foreach($errors->all() as $error)
           <li>{{$error}}</li>
         @endforeach
       </ul>
     </div>
   @endif

    <!-- Formulario para crear un nuevo usuario -->
    <form  action="{{ route('createuser')}}" method="post" id="formcreateuser">
      {{ csrf_field() }}
      <div class="form-group row">
        <label class="col-md-3 form-control-label">Nombre</label>
        <div class="col-md-9">
          <input type="text" name="name" class="form-control" placeholder="Nombre Usuario"  required>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-md-3 form-control-label">Correo</label>
        <div class="col-md-9">
          <input type="text" name="email" class="form-control" placeholder="Correo Usuario"  required>
        </div>
      </div>
        <div class="card-footer text-right">
        <button type="submit" {{--onclick="createuser('{{ route('createuser')}}')"--}} class="btn btn-sm btn-success" id="create-user" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Procesando">
          <i class="fa fa-dot-circle-o"></i> Guardar</button>
          <a href="{{ url('/users')}}" class="btn btn-sm btn-danger" >
            <i class="fa fa-ban"></i> Cancelar
          </a>
        </div>
      </form>
    </div>
  </section>
</aside>

@endsection

<!-- Codigo JavaScript -->
@section('script')
  
  <script>
    $(document).ready(function(){

      // Activar opción de user-create en sidebar
      $('#side-user-create').addClass('active');
      $('#side-user-general').addClass('menu-open').find('.treeview-menu').css("display", "block");
    });
  </script>

@endsection

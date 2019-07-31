@extends('layouts.app')

@section('content')
<div class="container mb-5 mt-5">
    <div class="row justify-content-center pb-5 pt-5">
        <div class="col-md-8 pb-5">
            <div class="card">
                <div class="card-header text-center">{{ __('Recuperar Contraseña') }}</div>
                <div class="card-body">
                    @if ($msg == 1)
                        <div class="alert alert-success">
                            El mensaje de recuperacion fue enviado exitosamente, revisa tu correo electronico.
                        </div>
                    @elseif($msg == 2)
                        <div class="alert alert-danger">
                            La cuenta de correo electronico no se encuentra en el sistema, imposible recuperar la contraseña.
                        </div>
                    @endif

                    <form method="POST" action="{{ action('UserController@resetpass') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Direccion de email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email"  required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Enviar Contraseña') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

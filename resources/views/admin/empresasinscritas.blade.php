@extends('layouts.app')

@section('content')

    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Empresas inscritas
            </h1>
            <hr>
        </section>
        <!-- Contenido de la vista -->
        <section class="content">
            <br>
            <div class="row">
                <div class="col-lg-12">
                    <div class="box">
                        <div class="box-body table-responsive">
                            <!-- Tabla usuarios -->
                            <table id="tableusers" class="tablabuscadora table table-bordered table-hover ">
                                <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Nit</th>
                                    <th>Correo</th>
                                    <th>Contacto</th>
                                    <th>Teléfono</th>
                                    <th>Ubicación</th>
                                    <th>Eliminar Entidad</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($empresas as $empresa)
                                    <tr>
                                        <td>{{$empresa->name_company}}</td>
                                        <td>{{$empresa->nit}}</td>
                                        <td>{{$empresa->email}}</td>
                                        <td>{{$empresa->name_contact}}</td>
                                        <td>{{$empresa->phone}}</td>
                                        <td>{{$empresa->ubication}}</td>
                                        <td class="action">
                                            <form id="formdelete_{{$empresa->id}}" method="POST" action="{{route('empresas.delete',$empresa->id)}}">
                                            {{ csrf_field() }}<!--Protección de ataques laravel(token)-->
                                                {{ method_field('DELETE') }}

                                                <button class="btn btn-link" type="button" onclick="sweetDelete({{$empresa->id}})" name="delete"><span class="oi oi-trash"></span></button>

                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </aside>

    {{--<!-- Modal editar usuario -->--}}
    {{--<div class="modal fade" id="modaledituser" tabindex="-1" role="dialog" style="z-index: 10000">--}}
        {{--<div class="modal-dialog" role="document">--}}
            {{--<div class="modal-content">--}}
                {{--<div class="modal-header" style="background-color: #0092a3;">--}}
                    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>--}}
                    {{--<h2 class="modal-title" id="exampleModalLabel">Editar Usuario</h2>--}}
                {{--</div>--}}
                {{--<!-- Formulario editar usuario -->--}}
                {{--<form   method="put" id="formupdateuser">--}}
                    {{--{{ csrf_field() }}--}}
                    {{--<div class="modal-body">--}}
                        {{--<div class="form-group">--}}
                            {{--<input type="text" class="hide" name="id" id="id">--}}
                            {{--<input type="hidden" name="_method" id="_method" value="put">--}}
                            {{--<label for="recipient-name">Nombre</label>--}}
                            {{--<input type="text" class="form-control" name="name" id="name" value="" required>--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="message-text" class="control-label">Correo</label>--}}
                            {{--<input type="text" class="form-control " name="email" id="email" value="" required>--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="recipient-name" class="control-label">Teléfono</label>--}}
                            {{--<input type="text" class="form-control" id="phone" name="phone" required>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</form>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection

<!-- Codigo JavaScript -->

@section('script')

    <script>
        $(document).ready(function(){

            // Activar opción de user en sidebar
            $('#side-user').addClass('active');
            $('#side-user-general').addClass('menu-open').find('.treeview-menu').css("display", "block");

            // Funcion para traducir la tabla usuarios
            var table = $('.tablabuscadora').DataTable({
                "language":{
                    "lengthMenu":"Mostrar _MENU_ registros por página.",
                    "zeroRecords": "Lo sentimos. No se encontraron registros.",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros aún.",
                    "infoFiltered": "(filtrados de un total de _MAX_ registros)",
                    "search" : "Buscar :",
                    "LoadingRecords": "Cargando ...",
                    "Processing": "Procesando...",
                    "SearchPlaceholder": "Comience a teclear...",
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Siguiente",
                    }
                }
            });
        });




        function sweetDelete(id_element){

            swal({
                    title: '¿Estas seguro?',
                    text: "Esta accion no se puede revertir!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Eliminarla!',
                    cancelButtonText: 'No, cancelar!',
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: false
                },
                function(){
                    // código que elimina
                    var id = "formdelete_"+id_element;
                    $("#"+id).submit();
                });

            // swal({
            //     title: '¿Estas seguro?',
            //     text: "Esta accion no se puede revertir!",
            //     type: 'warning',
            //     showCancelButton: true,
            //     confirmButtonColor: '#3085d6',
            //     cancelButtonColor: '#d33',
            //     confirmButtonText: 'Si, Eliminarla!',
            //     cancelButtonText: 'No, cancelar!',
            //     confirmButtonClass: 'btn btn-success',
            //     cancelButtonClass: 'btn btn-danger',
            //     buttonsStyling: false
            // }).then(function (id_element) {
            //
            //
            //         $(id).submit();
            //     }, function (dismiss) {
            //         // dismiss can be 'cancel', 'overlay',
            //         // 'close', and 'timer'
            //         if (dismiss === 'cancel') {
            //             swal(
            //                 'Cancelled',
            //                 'Your imaginary file is safe :)',
            //                 'error'
            //             )
            //         }
            //     }
            //
            // )
        }



    </script>

@endsection
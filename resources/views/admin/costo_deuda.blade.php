@extends('layouts.app')
@section('content')
    <style>
        /* Ensure that the demo table scrolls */
        div.DTFC_LeftHeadWrapper {

            margin-bottom: -13px;
        }

        div.DTFC_LeftBodyLiner {
            overflow: hidden;
            width: 100%;
        }

        .btn-primary{
            background-color: #027780;
            border: #027780;
        }

        .btn-primary:hover{
            background-color: #176580;
            border: #176580;
        }
    </style>
<div class="row mt-4">
    <div class="col-md-3">
        <h4>Promedio Tasas de interes</h4>
    </div>
    <div class="col">
        <button class="btn btn-primary downloadReport" style="">DESCARGAR INFORME <i class="fa fa-download"></i></button>
    </div>
</div>
<div class="row mt-4">
    <div class="col">
        <table id="costo_deuda_table" class="table table-striped bg-white nowrap" style="width:100%">
            <thead class="head-table text-center">
                <th scope="col">Entidad{{--Banco--}}</th>
                <th scope="col">Agricultura</th>
                <th scope="col">Explotacion</th>
                <th scope="col">Industria</th>
                <th scope="col">Electricidad</th>
                <th scope="col">Agua</th>
                <th scope="col">Construccion</th>
                <th scope="col">Comercio</th>
                <th scope="col">Transporte</th>
                <th scope="col">Alojamiento</th>
                <th scope="col">Comunicaciones</th>
                <th scope="col">Financieras</th>
                <th scope="col">Inmobiliarias</th>
                <th scope="col">Cientificas</th>
                <th scope="col">Administrativos</th>
                <th scope="col">Publica</th>
                <th scope="col">Educacion</th>
                <th scope="col">Salud</th>
                <th scope="col">Arte</th>
                <th scope="col">Otras</th>
                <th scope="col">Hogares</th>
                <th scope="col">Organizaciones</th>
                <th scope="col">No incluidas</th>
            </thead>
            <tbody class="body-admin text-center">
                @foreach($interes as $intereses )
                <tr>
                    <td>{{$intereses->banco}}</td>
                    <td>{{$intereses->agricultura}}</td>
                    <td>{{$intereses->explotacion}}</td>
                    <td>{{$intereses->industria}}</td>
                    <td>{{$intereses->electricidad}}</td>
                    <td>{{$intereses->agua}}</td>
                    <td>{{$intereses->construccion}}</td>
                    <td>{{$intereses->comercio}}</td>
                    <td>{{$intereses->transporte}}</td>
                    <td>{{$intereses->alojamiento}}</td>
                    <td>{{$intereses->comunicaciones}}</td>
                    <td>{{$intereses->financieras}}</td>
                    <td>{{$intereses->inmobiliarias}}</td>
                    <td>{{$intereses->cientificas}}</td>
                    <td>{{$intereses->administrativos}}</td>
                    <td>{{$intereses->publica}}</td>
                    <td>{{$intereses->educacion}}</td>
                    <td>{{$intereses->salud}}</td>
                    <td>{{$intereses->arte}}</td>
                    <td>{{$intereses->otras}}</td>
                    <td>{{$intereses->hogares}}</td>
                    <td>{{$intereses->organizaciones}}</td>
                    <td>{{$intereses->noincluidas}}</td>
                </tr>
                @endforeach()
            </tbody>
        </table>
    </div>
</div>





@endsection()
@section('script')
    <script src="https://cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js"></script>
    <script>

        $(document).ready(function() {

            $('.DTFC_LeftBodyLiner').css("overflow", "hidden");
            $('.DTFC_LeftHeadWrapper').css("margin-bottom","-13px");

            var table = $('#costo_deuda_table').DataTable( {
                // retrieve: true,
                language: {
                    decimal: "",
                    emptyTable: "No hay información",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    infoEmpty: "Mostrando 0 to 0 of 0 Entradas",
                    infoFiltered: "(Filtrado de _MAX_ total entradas)",
                    infoPostFix: "",
                    thousands: ",",
                    lengthMenu: "Mostrar _MENU_ Entradas",
                    loadingRecords: "Cargando...",
                    processing: "Procesando...",
                    search: "Buscar:",
                    zeroRecords: "Sin resultados encontrados",
                    paginate: {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                scrollX: true,
                scrollY: true,
                scrollCollapse: true,
                // columnDefs: [
                //     { orderable: false, targets: 0 },
                //     { orderable: false, targets: -1 }
                // ],
                // ordering: [[ 1, 'asc' ]],
                fixedHeader: true,

                // colReorder: {
                //     fixedColumnsLeft: 1,
                //     fixedColumnsRight: 1
                // }
            } );

            new $.fn.dataTable.FixedColumns( table, {
                leftColumns: 1,
            } );
        } );


        $(".downloadReport").click(function () {

            location.href = "{{route('get_costo_deuda_excel')}}";

        });


    </script>
@endsection()




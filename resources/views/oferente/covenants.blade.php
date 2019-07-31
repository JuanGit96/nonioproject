@extends('layouts.app')
@section('content')
<form action="" id="form_covenants">
    <div class="row mt-5 mb-3 pl-5 pr-5">
        <div class="col-lg-8">
            EBITDA/Gastos por Intereses
        </div>
        <div class="input-group col-lg-3">
            <input type="text" class="form-control " id="ebitda-interes" name="ebitda_interes" disabled>
            <div class="input-group-append">
                <span class="input-group-text">veces</span>
            </div>
        </div>
    </div>
    <div class="row mb-3 pl-5 pr-5">
        <div class="col-lg-8">
            Obligaciones financieras / EBITDA
        </div>
        <div class="input-group col-lg-3">
            <input type="text" class="form-control " id="of-ebitda" name="of_ebitda" disabled>
            <div class="input-group-append">
                <span class="input-group-text">veces</span>
            </div>
        </div>
    </div>
    <div class="row pl-5 pr-5">
        <div class="col-lg-8">
            Obligaciones financieras / financiación total
            <button type="button" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="top" title="financiación total = obligaciones financieras + patrimonio" >
            <span class="fas fa-question"></span> 
            </button>
        </div>
        <div class="input-group col-lg-3">
            <input type="text" class="form-control " id="of-financiacion" name="of_financiacion" disabled>
            <div class="input-group-append">
                <span class="input-group-text">%</span>
            </div>
        </div>
    </div>
    <div class="row mt-5 pl-5">
        <div class="btn-group mr-2 ml-3" role="group" >
            <button type="button" href="#" class="btn btn-info" id="edit_btn" onclick="activeEdit()">Editar</button>
        </div>
        <div class="btn-group mr-2" role="group" >
            <a class="btn btn-warning"  id="save_btn" >Guardar</a>
        </div>
        <div class="btn-group " role="group" >
            <button href="{{url('/covenants')}}" class="btn btn-danger" id="cancel_btn">Cancelar</button>
        </div>
    </div>
</form>
@endsection()
@section('script')
    <script>
    $(document).ready(function () {
        $('#save_btn').hide();                
        $('#cancel_btn').hide();                

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); 
        $.ajax({
            method: "GET",
            url: "/getcovenants" 
        }).done((res) => {
            document.getElementById("ebitda-interes").value= res.ebitda_interes  ;
            document.getElementById("of-ebitda").value= res.of_ebitda ;
            document.getElementById("of-financiacion").value= res.of_financiacion ;
            var save = document.getElementById('save_btn');
            save.setAttribute('onclick', 'editCovenant('+ res.id+')' );

        }).fail((error) => {
                alert("error, no se puede traer la información solicitada");
        });

    });

    </script>
@endsection()


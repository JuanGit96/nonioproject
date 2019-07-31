// Jquery

// Filtros
function filterColumnSolicitudes(i) {
    $('#solicitudes_table').DataTable().column(i).search($('#col' + i + '_filter').val()).draw();
}
function filterColumnHistorial(i) {
    $('#historial_table').DataTable().column(i).search($('#col' + i + '_filter').val()).draw();
}

var urlValidateEmail;
var urlValidateNombre;

$(document).ready(function () {

// DataTables
    $('#example,#table-detalle,#solicitudes_table,#historial_table').DataTable({
        "scrollX": true,
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
                first: "Primero",
                last: "Ultimo",
                next: "Siguiente",
                previous: "Anterior"
            }
        }
    });
    $('#patrimonio_tableadmin').DataTable({
        "scrollY": "250px",
        "scrollCollapse": true,
        language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
        "paging": false
    });

// Funcion para filtrar
    $('select.column_filter').on('keyup click', function () {
        filterColumnSolicitudes($(this).parents('td').attr('data-column'));
    });
    $('select.column_filter_historial').on('keyup click', function () {
        filterColumnHistorial($(this).parents('td').attr('data-column'));
    });



// Validacion nit y nombre empresa y valor

    $("#demandSubmit").click(function (event) {
        document.getElementById("demandSubmit").disabled = true;
        document.getElementById("demandSubmit").value = "Cargando...";
        var max = document.getElementById("max").value;
        var split = document.getElementById("value_requested").value.split(',').join('');
        var val = parseFloat(split);
        var maxval = parseFloat(max);
        if (val > maxval) {
            document.getElementById('value_requested').focus()
            $('.value_requested-error').show();
            $("#value_requested").css("border", "1px solid red");
            document.getElementById("demandSubmit").disabled = false;
            document.getElementById("demandSubmit").value = "Enviar";
        } else if (val < 5000000) {
            document.getElementById('value_requested').focus()
            $('.value_requested-error').show();
            $('.value_requested-error').text('El valor tiene que ser mayor a 5´000.000');
            $("#value_requested").css("border", "1px solid red");
            document.getElementById("demandSubmit").disabled = false;
            document.getElementById("demandSubmit").value = "Enviar";
        } else {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "POST",
                url: urlValidateNombre,
                data: $("#formdemand").serialize()
            }).done((res) => {

                if (res.mensaje == "siname") {
                    document.getElementById('name_company').focus();
                    $('.name_company-error').show();
                    document.getElementById("demandSubmit").disabled = false;
                    document.getElementById("demandSubmit").value = "Enviar";
                    $("#name_company").css("border", "1px solid red");

                } else if (res.mensaje == "nitsi") {
                    document.getElementById('nit').focus();
                    $('.nit-error').show();
                    document.getElementById("demandSubmit").disabled = false;
                    document.getElementById("demandSubmit").value = "Enviar";

                } else if (res.mensaje == "namesinitsi") {
                    document.getElementById('name_company').focus();
                    $('.name_company-error').show();
                    document.getElementById('nit').focus();
                    $('.nit-error').show();
                    document.getElementById("demandSubmit").disabled = false;
                    document.getElementById("demandSubmit").value = "Enviar";

                } else {
                    $("#formdemand").submit();
                }
            }).fail((error) => {
                //Si la repuesta al controlador no es correcta, se muestra un modal con el error.
                swal("Oops...", "Verfica que se hayan completado todos los campos", "error");
            });
        }
    });

// Validación del email
    
    $("#simulationSubmit").click(function (event) {
        document.getElementById("simulationSubmit").disabled = true;
        document.getElementById("simulationSubmit").value = "Cargando...";
        var income = document.getElementById("income").value.split(',').join('');
        var heritage_value = document.getElementById("heritage_value").value.split(',').join('');

        if (income < 999999) {
            document.getElementById('income').focus();
            $('.income-error').show();
            $('.heritage_value-error').hide();
            document.getElementById("simulationSubmit").disabled = false;
            document.getElementById("simulationSubmit").value = "Aceptar";
            $("#income").css("border", "1px solid red");
        } else if (heritage_value < 999999) {
            document.getElementById('heritage_value').focus();
            $('.income-error').hide();
            $('.heritage_value-error').show();
            document.getElementById("simulationSubmit").disabled = false;
            document.getElementById("simulationSubmit").value = "Aceptar";
            $("#heritage_value").css("border", "1px solid red");
        } else {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $.ajax({
                method: "PUT",
                url: urlValidateEmail,
                data: $("#formSimulation").serialize()
            }).done((res) => {
                
                if (res.mensaje == "si") {
                    $('.heritage_value-error').hide();
                    $('.income-error').hide();
                    document.getElementById('email_contact').focus();
                    $("#email_contact").css("border", "1px solid red");
                    $('.email-error').show();
                    document.getElementById("simulationSubmit").disabled = false;
                    document.getElementById("simulationSubmit").value = "Aceptar";
                } else {
                    $("#formSimulation").submit();
                }
            }).fail((error) => {
                //Si la repuesta al controlador no es correcta, se muestra un modal con el error.
                swal("Oops...", "Verfica que se hayan completado todos los campos", "error");
            });
        }
    });



// Puntuacion para los valores
    $('#income,#operating_costs,#sale_value,#depreciation_costs,#amortization_costs,#financial_obligations,#heritage_value,#input_value').priceFormat({
        prefix: '',
        centsLimit: 0,
    });
    $('#value_requested').priceFormat({
        prefix: '',
        centsLimit: 0,
    });

// Funcion para el modal
    $("#btnlogin").click(function () {
        $("#modal_infoSolicitud").show();
    });

// Funcion para el calendario   
    // $('#datePicker').datepicker({
    //         format: " yyyy",
    //         viewMode: "years",
    //         minViewMode: "years"
    //     });

// Activa el tooltip
    $('[data-toggle="tooltip"]').tooltip();

// Da funcion segun la url
    var URLactual = window.location;
    if (URLactual.pathname == '/') {
        $(".main-header").css("position", "fixed");
        $(".main-header").css("z-index", "1000");
        $(".main-header").css("width", "100%");
        $("#btnhowworks").click(function () {
            $('html, body').animate({
                scrollTop: $("#howworks").offset().top
            }, 1000);
        });
        $("#btnwhoare").click(function () {
            $('html, body').animate({
                scrollTop: $("#whoare").offset().top
            }, 1000);
        });
        $("#btnhowdo").click(function () {
            $('html, body').animate({
                scrollTop: $("#howdo").offset().top
            }, 1000);
        });
        $("#scroll-btn ").click(function () {
            $('html, body').animate({
                scrollTop: $("#howworks").offset().top
            }, 1000);
        });
        $("#scroll-simulation ").click(function () {
            $('html, body').animate({
                scrollTop: $("#clients").offset().top
            }, 1000);
        });
    } else {
        $("#btnhowworks").click(function () {
            window.location.href = "/";
        });
        $("#btnwhoare").click(function () {
            window.location.href = "/";
        });
        $("#btnhowdo").click(function () {
            window.location.href = "/";
        });
        $("#scroll-btn ").click(function () {
            window.location.href = "/";
        });
    }

    /*Mostrar datos almacenados*/

    var sliderMonto = document.getElementById("monto");
    var outputMonto = document.getElementById("Montocantidad");

    if (sliderMonto !== null){
        outputMonto.innerHTML = sliderMonto.value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");

        sliderMonto.oninput = function () {
            outputMonto.innerHTML = this.value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        };
    }

// Slider logos
    $('.customer-logos').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 3
                }
            }, {
                breakpoint: 520,
                settings: {
                    slidesToShow: 2
                }
            }]
    });
});

var urlApplication;
// Guarda los datos para la solicitud
var application = (id) => {

    var monto = document.getElementById("prestamo" + id).innerText.split('.').join('');
    var tasainteres = document.getElementById("tasa" + id).innerText;
    var plazo = document.getElementById("plazomodal" + id).innerText;


    swal({
        title: "¿Estás seguro?",
        text: "Recuerda que solo puedes solicitarlo una vez",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Acepto",
        closeOnConfirm: true
    }, function () {
        datos = {
            'id': id,
            'monto': monto,
            'tasainteres': tasainteres,
            'plazo': plazo,
        };
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "POST",
            url: urlApplication,
            data: datos

        }).done((res) => {
            // var acep = document.getElementById('acep');
            // acep.setAttribute('href', '/solicitudes/' + res);
            $('#solicitar_modal').modal('show');
        }).fail((error) => {
            //Si la respuesta es negativa se oculta es modal y se muestra el error
            swal("Oops...", "Error en el servidor", "error");
        });
    });


};

// Funcion que solo permite numeros
function valida(e) {
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }

    // Patron de entrada, en este caso solo acepta numeros
    patron = /[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}


//Funcion que  direcciona a la ruta donde va al controlador para actualizar la contraseña.
var changePass = () => {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        method: "PUT",
        url: "/changepassword",
        data: $("#formchangepass").serialize(),
    }).done((res) => {
        console.log(res);
        //Si la respuesta del controlador es correcta, muestra un modal de informacion que recarga la pagina.
        if (res.mensaje == 'noactual') {
            document.getElementById("formchangepass").reset();
            swal("Error...", "La contraseña actual no es la correcta", "error");
        } else if (res.mensaje == 'noigual') {
            document.getElementById("formchangepass").reset();
            swal("Error...", "Las contraseñas no coinciden", "error");
        } else if (res.mensaje == 'Se ha actualizado la contraseña') {
            swal({
                title: "Proceso Exitoso",
                text: res.mensaje,
                icon: "success",
                buttons: true,
                buttons: {
                    confirm: "Aceptar",
                },
            }, function (params) {
                location.reload();
            });
        } else {
            swal("Error...", "Ocurrio un problema con el servidor", "error");
        }
    }).fail((error) => {
        //Si la repuesta al controlador no es correcta, se muestra un modal con el error.
        document.getElementById("formchangepass").reset();
        swal("Oops...", "Verfica que se hayan completado todos los campos", "error");
    });

}

// Activa los botones para guardar en covenants
var activeEdit = () => {
    $('#save_btn').show();
    $('#cancel_btn').show();
    $("#edit_btn").prop("disabled", true);

    $("#ebitda-interes").prop("disabled", false);
    $("#of-ebitda").prop("disabled", false);
    $("#of-financiacion").prop("disabled", false);

}

//Funcion para editar los covenants.
var editCovenant = (id) => {

    swal({
        title: "¿Estas seguro de editar este covenant ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        buttons: {
            cancel: "Cancelar",
            confirm: "Aceptar",
        }
    }, function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "PUT",
            url: "/editarcovenant/" + id,
            data: $("#form_covenants").serialize(),
        }).done((res) => {
            swal({
                title: "Proceso Exitoso",
                text: "Los covenants han sido actualizados",
                type: "success",
                buttons: true,
                buttons: {
                    confirm: "Aceptar",
                },
            }, function () {
                location.reload();
            });

        }).fail((error) => {
            //Si la repuesta al controlador no es correcta, se muestra un modal con el error.
            swal("Oops...", "Verfica que se hayan completado todos los campos", "error");
        });
    })
}
// swal({
//     title: "¿Esta seguro de editar este covenant ?",
//     icon: "warning",
//     buttons: true,
//     dangerMode: true,
//     buttons: {
//         cancel: "Cancelar",
//         confirm: "Aceptar",
//     }
// }).then((ok) => {
// console.log(ok);
// if (ok) {
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
//     $.ajax({
//         method: "PUT",
//         url: "/editarcovenant/"+id,
//         data: $("#form_covenants").serialize(),
//     }).done((res) => {
//         swal({
//             title: "Proceso Exitoso",
//             text: "Los covenants han sido actualizados",
//             type: "success",
//             buttons: true,
//             buttons: {
//                 confirm: "Aceptar",
//             },
//         },function () {
//                 location.reload();
//         });

//     }).fail((error) => {
//         //Si la repuesta al controlador no es correcta, se muestra un modal con el error.
//         swal("Oops...", "Verfique que se hayan completado todos los campos", "error");
//     });
// }
// });


// Activa los botones para guardar en tasas y plazos
var activeEditTasas = () => {
    $('#save_btn_tasas').show();
    $('#cancel_btn_tasas').show();
    $("#edit_btn_tasas").prop("disabled", true);

    $("#90").prop("disabled", false);
    $("#180").prop("disabled", false);
    $("#un_ano").prop("disabled", false);
    $("#dos_anos").prop("disabled", false);
    $("#mas_dos_anos").prop("disabled", false);
}
//guardar tasa
var guardartasas = () => {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        method: "PUT",
        url: '/guardartasas',
        data: $("#form_tasas").serialize(),
    }).done((res) => {
        //Si la respuesta del controlador es correcta, muestra un modal de informacion que recarga la pagina.
        swal({
            title: "Registro Exitoso!",
            text: res.mensaje,
            type: "success"
        }, function () {
            location.reload(true);
        });
    }).fail((error) => {
        //Si la repuesta al controlador no es correcta, se muestra un modal con el error.
        swal("Oops...", "Verfica que se hayan completado todos los campos", "error");
    });


}

var urlVetar;
var Betar = (id) => {
    swal({
        title: "¿Deseas Vetar este sector?",
        text: "Presiona Vetar para hacerlo",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Vetar",
        closeOnConfirm: false,
        html: false
    }, function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //Realiza la consulta delete que tiene por parametro el id y la url enviada desde la vista.
        $.ajax({
            method: "get",
            url: urlVetar + id
        }).done((res) => {

            console.log(res);
            //Si la respuesta del controlador es correcta se muestra un modal indicando que la operacion es exitosa.
            swal({
                title: "!Vetado!",
                type: "success"
            }, function () {
                //Cuando se da en el boton ok se redirige a esta direccion.
                location.reload(true);
            });
        }).fail((error) => {
            //Si la respuesta del controlador es incorrecta se muestra el modal sobre el error.
            swal("Error!",
                    "No se puede vetar este sector",
                    "error");
        });

    });
};

var urlHabilitar;
var HabilitarSector = (id) => {
    swal({
        title: "¿Deseas Habilitar este sector?",
        text: "Preciona Habilitar para hacerlo",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Habilitar",
        closeOnConfirm: false,
        html: false
    }, function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //Realiza la consulta delete que tiene por parametro el id y la url enviada desde la vista.
        $.ajax({
            method: "get",
            url: urlHabilitar + id
        }).done((res) => {

            console.log(res);
            //Si la respuesta del controlador es correcta se muestra un modal indicando que la operacion es exitosa.
            swal({
                title: "!Habilitado!",
                type: "success"
            }, function () {
                //Cuando se da en el boton ok se redirige a esta direccion.
                location.reload(true);
            });
        }).fail((error) => {
            //Si la respuesta del controlador es incorrecta se muestra el modal sobre el error.
            swal("Error!",
                    "No se puede habilitar este sector",
                    "error");
        });

    });
};
//Funcion para editar los covenants.
var editTasas = (id) => {
    swal({
        title: "¿Estas seguro de editar las tasas de este sector ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        buttons: {
            cancel: "Cancelar",
            confirm: "Aceptar",
        },
    }, function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "PUT",
            url: "/editartasas/" + id,
            data: $("#form_tasas").serialize(),
        }).done((res) => {
            swal({
                title: "Proceso Exitoso",
                text: "Las tasas han sido actualizados",
                icon: "success",
                buttons: true,
                buttons: {
                    confirm: "Aceptar",
                },
            }, function () {
                location.reload();
            });
        }).fail((error) => {
            //Si la repuesta al controlador no es correcta, se muestra un modal con el error.
            swal("Oops...", "Verfica que se hayan completado todos los campos", "error");
        });
    });
}

// Activa los botones para guardar costo de patrimonio
var activeEditPatrimonio = () => {
    $('#save_btn').show();
    $('#cancel_btn').show();
    $("#edit_btn").prop("disabled", true);
    $("#input-tasalibre").prop("disabled", false);
    $("#input-EMBI").prop("disabled", false);
    $("#input-tasa_impuestos").prop("disabled", false);
    $("#input-prima_mercado").prop("disabled", false);
    $("#input-inflacion_colombia").prop("disabled", false);
    $("#input-inflacion_usa").prop("disabled", false);
}

//Funcion para editar los costos de patrimonio.
var editCostoPatrimonio = (id) => {
    swal({
        title: "¿Estas seguro de editar los valores de costo patrimonio ?",
        type: "warning",
        dangerMode: true,
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Acepto",
        closeOnConfirm: false
    }, function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "PUT",
            url: "/editarcostopatrimonio/" + id,
            data: $("#form_patrimonio").serialize(),
        }).done((res) => {
            swal({
                title: "Proceso Exitoso",
                text: "Los costos han sido actualizados",
                type: "success",
                buttons: true,
                buttons: {
                    confirm: "Aceptar",
                },
            }, function () {

                location.reload();
            });


        }).fail((error) => {
            //Si la repuesta al controlador no es correcta, se muestra un modal con el error.
            swal("Oops...", "Verfica que se hayan completado todos los campos", "error");
        });
    });
}

// Activa los botones para guardar costo de patrimonio
var activeEditBeta = ($id) => {
    swal({
        title: "Editar beta desapalancado:",
        type: "input",
        showCancelButton: true,
        closeOnConfirm: false,
    }, function (inputValue) {
        var valor = inputValue;
        if (inputValue === false)
            return false;
        if (inputValue === "" || !isFinite(String(inputValue))) {
            swal.showInputError("Valor invalido");
            return false
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "PUT",
            url: "/editarbeta/" + $id,
            data: {valor},
        }).done((res) => {
            location.reload();

        }).fail((error) => {
            //Si la repuesta al controlador no es correcta, se muestra un modal con el error.
            swal("Oops...", "Verfica que se hayan completado todos los campos", "error");
        });
    });
}
//Funcion para editar los costos de patrimonio.
var editBeta = (id) => {
    swal({
        title: "¿Estas seguro de editar los beta de este sector ?",
        type: "warning",
        buttons: true,
        dangerMode: true,
        buttons: {
            cancel: "Cancelar",
            confirm: "Aceptar",
        },
    }, function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "PUT",
            url: "/editarbeta/" + id,
            data: $("#form_beta").serialize(),
        }).done((res) => {
            swal({
                title: "Proceso Exitoso",
                text: "El beta ha sido actualizado",
                icon: "success",
                buttons: true,
                buttons: {
                    confirm: "Aceptar",
                },
            }, function () {
                location.reload();
            });
        }).fail((error) => {
            //Si la repuesta al controlador no es correcta, se muestra un modal con el error.
            swal("Oops...", "Verfica que se hayan completado todos los campos", "error");
        });
    });
}

//Ver mas de la solicitud banco
var vermas = (id) => {
    document.getElementById("banco").innerHTML = document.getElementById("banco" + id).innerText;
    document.getElementById("prestamo").innerHTML = document.getElementById("prestamo" + id).innerText;
    document.getElementById("tasa").innerHTML = document.getElementById("tasa" + id).innerText;
    document.getElementById("plazomodal").innerHTML = document.getElementById("plazomodal" + id).innerText;
    // document.getElementById("cuota").innerHTML = document.getElementById("cuota" + id).innerText;
    var btn = document.getElementById('solicitarbtn');
    btn.setAttribute('onclick', 'application(' + id + ')');
    $("#vermas_modal").modal("show");

};


// Editar el estado

var showState = (id) => {
    document.getElementById("id_aplicacion").value = id;
    $("#modal_estado").modal("show");
    $('#Enestudio').attr('disabled', false).show();
    $('#Rechazada').attr('disabled', false).show();
    $('#Iniciado').attr('disabled', true).hide();
    $('#Contactado').attr('disabled', true).hide();
    $('#Finalizado').attr('disabled', true).hide();
    $('#Aceptada').attr('disabled', true).hide();
}

var showStateContactado = (id) => {
    document.getElementById("id_aplicacion").value = id;
    $('#Enestudio').attr('disabled', true).hide();
    $('#Rechazada').attr('disabled', false).show();
    $('#Iniciado').attr('disabled', true).hide();
    $('#Contactado').attr('disabled', true).hide();
    $('#Finalizado').attr('disabled', false).show();
    $('#Aceptada').attr('disabled', true).hide();

    $("#modal_estado").modal("show");
}

var showStateAceptada = (id) => {
    document.getElementById("id_aplicacion").value = id;
    $('#Enestudio').attr('disabled', true).hide();
    $('#Rechazada').attr('disabled', false).show();
    $('#Iniciado').attr('disabled', true).hide();
    $('#Contactado').attr('disabled', false).show();
    $('#Finalizado').attr('disabled', false).hide();
    $('#Aceptada').attr('disabled', true).hide();

    $("#modal_estado").modal("show");
}

var showStateEnestudio = (id) => {
    document.getElementById("id_aplicacion").value = id;
    $('#Enestudio').attr('disabled', true).hide();
    $('#Rechazada').attr('disabled', false).show();
    $('#Iniciado').attr('disabled', true).hide();
    $('#Contactado').attr('disabled', true).hide();
    $('#Finalizado').attr('disabled', true).hide();
    $('#Aceptada').attr('disabled', false).show();

    $("#modal_estado").modal("show");
}

var urlShowPyme;
var showPyme = (id) => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        method: "get",
        url: urlShowPyme + id
    }).done((res) => {
        //Si la respuesta del controlador es correcta, muestra un modal de informacion que recarga la pagina.
        console.log(res);

        if ($('#nit').length) {
            document.getElementById("nit").innerHTML = res.nit;
            document.getElementById("name_company").innerHTML = res.name_company;
            document.getElementById("name_contact").innerHTML = res.name_contact;
            document.getElementById("phone").innerHTML = res.phone;
            document.getElementById("ubication").innerHTML = res.ubication;
        }

        document.getElementById("income").innerHTML = "$"+ parseFloat(res.income,10).toFixed(0).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        document.getElementById("sale_value").innerHTML = "$"+ parseFloat(res.sale_value,10).toFixed(0).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        document.getElementById("operating_costs").innerHTML = "$"+ parseFloat(res.operating_costs,10).toFixed(0).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        document.getElementById("depreciation_costs").innerHTML = "$"+ parseFloat(res.depreciation_costs,10).toFixed(0).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        document.getElementById("amortization_costs").innerHTML = "$"+ parseFloat(res.amortization_costs,10).toFixed(0).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        document.getElementById("financial_obligations").innerHTML = "$"+ parseFloat(res.financial_obligations,10).toFixed(0).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        document.getElementById("heritage_value").innerHTML = "$"+ parseFloat(res.heritage_value,10).toFixed(0).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");

        $("#modal_pyme").modal("show");


    }).fail((error) => {
        //Si la repuesta al controlador no es correcta, se muestra un modal con el error.
        $("#moda_pyme").modal("hide");
        swal("Oops...", "Verfica que se hayan completado todos los campos", "error");
    });
}

var showPyme2 = (id) => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        method: "get",
        url: urlShowPyme + id
    }).done((res) => {
        //Si la respuesta del controlador es correcta, muestra un modal de informacion que recarga la pagina.
        console.log(res);

        if ($('#nit').length) {
            document.getElementById("nit").innerHTML = res.nit;
            document.getElementById("name_company").innerHTML = res.name_company;
            document.getElementById("name_contact").innerHTML = res.name_contact;
            document.getElementById("phone").innerHTML = res.phone;
            document.getElementById("ubication").innerHTML = res.ubication;
        }

        document.getElementById("income2").innerHTML = "$"+ parseFloat(res.income,10).toFixed(0).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        document.getElementById("sale_value2").innerHTML = "$"+ parseFloat(res.sale_value,10).toFixed(0).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        document.getElementById("operating_costs2").innerHTML = "$"+ parseFloat(res.operating_costs,10).toFixed(0).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        document.getElementById("depreciation_costs2").innerHTML = "$"+ parseFloat(res.depreciation_costs,10).toFixed(0).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        document.getElementById("amortization_costs2").innerHTML = "$"+ parseFloat(res.amortization_costs,10).toFixed(0).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        document.getElementById("financial_obligations2").innerHTML = "$"+ parseFloat(res.financial_obligations,10).toFixed(0).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        document.getElementById("heritage_value2").innerHTML = "$"+ parseFloat(res.heritage_value,10).toFixed(0).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        
        document.getElementById("ebitda").innerHTML = "$"+ parseFloat(res.ebitda,10).toFixed(0).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        document.getElementById("covenant1").innerHTML = "$"+ parseFloat(res.cec,10).toFixed(0).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        document.getElementById("covenant2").innerHTML = "$"+ parseFloat(res.cecc,10).toFixed(0).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        document.getElementById("covenant3").innerHTML = "$"+ parseFloat(res.ces,10).toFixed(0).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        document.getElementById("covenant4").innerHTML = "$"+ parseFloat(res.cea,10).toFixed(0).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");

        $("#modal_pyme2").modal("show");


    }).fail((error) => {
        //Si la repuesta al controlador no es correcta, se muestra un modal con el error.
        $("#moda_pyme").modal("hide");
        swal("Oops...", "Verfica que se hayan completado todos los campos", "error");
    });
}

var urlChangeState;
var changeState = () => {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        method: "PUT",
        url: urlChangeState,
        data: $("#form_estado").serialize(),
    }).done((res) => {
        //Si la respuesta del controlador es correcta, muestra un modal de informacion que recarga la pagina.
        $("#modal_estado").modal("hide");
        swal({
            title: "Proceso Exitoso",
            text: "El estado ha sido actualizado",
            icon: "success",
            buttons: true,
            buttons: {
                confirm: "Aceptar",
            },
        }, function () {
            location.reload();
        });

    }).fail((error) => {
        //Si la repuesta al controlador no es correcta, se muestra un modal con el error.
        $("#modal_estado").modal("hide");
        swal("Oops...", "Verfica que se hayan completado todos los campos", "error");
    });

}

var tasasyplazos = (id, url) => {
    //Guarda el id del cliente para pasarlo a la siguiente funcion.
    this.id = id;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    /*Realiza la consulta GET con la url determinada en las rutas, 
     se le envia el id recibido por el boton.
     */
    $.ajax({
        method: "GET",
        url: url

    }).done((res) => {

        /*Si la respuesta del controlador es correcta, se llama con el id cada uno de 
         los inputs para enviarle la informacion de la respuesta del controlador
         */
        console.log("aqui",res);
        document.getElementById("interes").value = id;
        document.getElementById("noventa").value = res.noventa;
        document.getElementById("ciento_ochenta").value = res.ciento_ochenta;
        document.getElementById("un_ano1").value = res.un_ano;
        document.getElementById("dos_anos1").value = res.dos_anos;
        document.getElementById("mas_dos_anos1").value = res.mas_dos_anos;
    }).fail((error) => {
        //Si la respuesta es negativa se oculta es modal y se muestra el error
        $('#cargando').fadeOut('slow');
        alert("error, 3 no se puede traer la información solicitada");
    });
};

var urlUpdatetasas;

var updatetasainteres = () => {

    //Valida los campos del formulario para actualizar un usuario.
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /*Realiza la consulta PUT con la url determinada en las rutas, junto a la ruta 
     se envia el id que toma de la variable this.id.
     */
    console.log("urlUpdateTasas", urlUpdatetasas);
    $.ajax({
        method: "PUT",
        url: urlUpdatetasas + this.id,
        data: $("#formedittasas").serialize()
    }).done((res) => {
        /*Si la respuesta del controlador es correcta,se muestra un modal confirmando que la opracion
         fue correcta
         */

        // $('#modaleditarcliente').modal('toggle');
        swal({
            title: "Registro Exitoso!",
            text: res.mensaje,
            type: "success"
        }, function () {
            location.reload();

        });


    }).fail((error) => {
        //Si la respuesta es negativa se oculta es modal y se muestra el error
        $('#modaleditarcliente').modal('toggle');
        swal("Oops...", "Verfica que se hayan completado todos los campos", "error");
    });
}

var createuser = (url) => {
    //Valida los datos ingresados en la vista de crear usuario.
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    /*Realiza la consulta POST a traves de la url enviada en la vista,
     toma los datos del formulario de la vista mediante la funcion serialize.
     */
    $.ajax({
        method: "POST",
        url: url,
        data: $("#formcreateuser").serialize(),
    }).done((res) => {

        //Si la respuesta del controlador es correcta se muestra un modal indicando que el proceso fue exitodo.
        swal({
            title: "Registro Exitoso!",
            text: res.mensaje,
            type: "success"
        }, function () {
            //Cuando se da en el boton ok se redirige a esta direccion.
            window.location.href = "./users";
        });
    }).fail((error) => {
        //Si la respuesta del contralador es incorrecta se muestra un modal indicando el ei
        swal("Oops...", "Problemas con el servidor.", "error");
    });

};

var registerOfer;
var saveOffer = () => {
    $('#saveOfferbtn').attr("disabled", true);
    $("#saveOfferbtn").html('Cargando...');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        method: "POST",
        url: registerOfer,
        data: $("#formcreateoffer").serialize(),
    }).done((res) => {
        //Si la respuesta del controlador es correcta, muestra un modal de informacion que recarga la pagina.
        if (res.mensaje == "errorEmail") {
            document.getElementById('email').focus();
            $('.email-error').show();
            $('#saveOfferbtn').attr("disabled", false);
            $("#saveOfferbtn").html('Guardar');
            $('.nit-error').hide();
            $('.name-error').hide();

        } else if (res.mensaje == "errorNit") {
            $('.nit-error').show();
            $('#saveOfferbtn').attr("disabled", false);
            $("#saveOfferbtn").html('Guardar');
            $('.email-error').hide();
            $('.name-error').hide();
        } else if (res.mensaje == "errorEmpresa") {
            $('.name-error').show();
            $('#saveOfferbtn').attr("disabled", false);
            $("#saveOfferbtn").html('Guardar');
            $('.email-error').hide();
            $('.nit-error').hide();
        } else {
            swal({
                html: true,
                title: "Proceso Exitoso",
                text: "Se ha creado una nueva entidad financiera y se ha enviado la información de contacto al correo electrónico.<br><br><strong>Usuario: </strong>"+ res.usuario + "<br><strong>Clave: </strong>" + res.clave,
                type: "success",
                buttons: true,
                buttons: {
                    confirm: "Aceptar",
                },
            }, function () {
                location.reload();
            });
        }

    }).fail((error) => {
        //Si la repuesta al controlador no es correcta, se muestra un modal con el error.
        $('#saveOfferbtn').attr("disabled", false);
        $("#saveOfferbtn").html('Guardar');
        swal("Oops...", "Verfica que se hayan completado todos los campos", "error");
    });

}



// Fin JQuery

// Vue Js


/* validacion de formulario de proveedores*/

var demand = new Vue({
    el: "#demand",
    data: {
        nit: {
            input: "",
            mensaje: "",
            clase: "",
        },
        name_contact: {
            input: "",
            mensaje: "",
            clase: "",
        },
        phone_contact: {
            input: "",
            mensaje: "",
            clase: "",
        },
        ubication: {
            input: "",
            mensaje: "",
            clase: "",
        }
    },
    methods: {
        escribir: function (data) {
            if (!(data.input).trim()) {
                data.mensaje = "Este campo es obligatorio ";
                data.clase = "invalid";
            } else if (data.input.search(/^[0-9.,]*$/)) {
                data.mensaje = "El campo debe contener solo numeros";
                data.clase = "invalid";
            } else {
                data.mensaje = "";
                data.clase = "valid";
            }
        },
        escribirLetras: function (data) {
            if (!(data.input).trim()) {
                data.mensaje = "Este campo es obligatorio ";
                data.clase = "invalid";
            } else if (data.input.search(/^[a-zA-Z\sáéíóúÁÉÍÓÚ]*$/)) {
                data.mensaje = "El campo debe contener solo letras";
                data.clase = "invalid";
            } else {
                data.mensaje = "";
                data.clase = "valid";
            }
        },
        checkForm: function (e) {
            document.getElementById("SubmitDemand").disabled = true;
            document.getElementById("SubmitDemand").value = "Cargando...";
            var min = document.getElementById("min").value;
            var max = document.getElementById("max").value;
            var split = document.getElementById("value_requested").value.split(',').join('');
            var val = parseFloat(split);
            var minval = parseFloat(min);
            var maxval = parseFloat(max);

            if (val > maxval) {
                e.preventDefault();
                document.getElementById('value_requested').focus()
                $('.value_requested-error').show();
            } else {
                return true;
            }
        },
    }
});

var register = new Vue({
    el: "#register",
    data: {
        name: {
            input: "",
            mensaje: "",
            clase: "",
        },
        financial_entity: {
            input: "",
            mensaje: "",
            clase: "",
        },
        charge: {
            input: "",
            mensaje: "",
            clase: "",
        },
        phone: {
            input: "",
            mensaje: "",
            clase: "",
        },
        email: ''
    },
    methods: {
        escribir: function (data) {

            if (!(data.input).trim()) {
                data.mensaje = "Este campo es obligatorio ";
                data.clase = "invalid";
            } else if (data.input.search(/^[0-9]*$/)) {
                data.mensaje = "El campo debe contener solo numeros";
                data.clase = "invalid";

            } else {

                data.mensaje = "";
                data.clase = "valid";
            }
        },
        escribirLetras: function (data) {
            if (!(data.input).trim()) {
                data.mensaje = "Este campo es obligatorio ";
                data.clase = "invalid";
            } else if (data.input.search(/^[a-zA-Z\s]*$/)) {
                data.mensaje = "El campo debe contener solo letras";
                data.clase = "invalid";
            } else {
                data.mensaje = "";
                data.clase = "valid";
            }
        },
        register: function (e) {
            var url = 'user';
            axios.post(url, {
                name: this.name.input,
                financial_entity: this.financial_entity.input,
                charge: this.charge.input,
                phone: this.phone.input,
                email: this.email,
            }).then(response => {
                this.errors = [];
                this.name.input = "";
                this.financial_entity.input = "";
                this.charge.input = "";
                this.phone.input = "";
                this.email = "";
                toastr.success('Fue guardado', 'Exito', {timeOut: 5000});
            }).catch(error => {
                this.errors = error.response.data
            })
        }
    }
});

/* editar perfil empresa*/

var editdata = (id, url) => {
    //Guarda el id del cliente para pasarlo a la siguiente funcion.
    this.id = id;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    /*Realiza la consulta GET con la url determinada en las rutas, 
     se le envia el id recibido por el boton.
     */
    $.ajax({
        method: "GET",
        url: url
    }).done((res) => {
        /*Si la respuesta del controlador es correcta, se llama con el id cada uno de 
         los inputs para enviarle la informacion de la respuesta del controlador
         */
        document.getElementById("nit").value = res.nit;
        document.getElementById("compañia").value = res.name_company;
        document.getElementById("contacto").value = res.name_contact;
        document.getElementById("phone").value = res.phone;
        document.getElementById("ubication").value = res.ubication;
        document.getElementById("id").value = id;


    }).fail((error) => {
        //Si la respuesta es negativa se oculta es modal y se muestra el error
        $('#cargando').fadeOut('slow');
        alert("error, no se puede traer la información solicitada");
    });
};


var updatedata = () => {
    //Valida los campos del formulario para actualizar un usuario.

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    /*Realiza la consulta PUT con la url determinada en las rutas, junto a la ruta 
     se envia el id que toma de la variable this.id.
     */
    $.ajax({
        method: "PUT",
        url: "/updatedata/",
        data: $("#formeditdemanda").serialize(),
    }).done((res) => {
        /*Si la respuesta del controlador es correcta,se muestra un modal confirmando que la opracion
         fue correcta
         */
        console.log(res);
        $('#modal_editdata').modal('toggle');
        swal({
            title: "Registro Exitoso!",
            text: res.mensaje,
            type: "success"
        }, function () {
            window.location.href = "/getuser";
        });
    }).fail((error) => {
        //Si la respuesta es negativa se oculta es modal y se muestra el error
        $('#modaleditarcliente').modal('toggle');
        swal("Oops...", "Verfica que se hayan completado todos los campos", "error");
    });

}

$(function() {

    let currentURL = window.location.href;

    $(document).on("click", ".newMesa", function(e) {

        e.preventDefault();
        let url = currentURL + '/mesas';
        let _token = $("meta[name=csrf-token]").attr("content");

        $.post(url, {
            _token: _token
        }, function(data, textStatus, xhr) {

            $('.viewResult').html(data);

        }).fail(function(data) {
            printErrorMsg(data.responseJSON.errors);
        });

    });

    $(document).on("click", ".mesa", function(e) {

        e.preventDefault();
        $('.mesa').removeClass('border border-primary bg-primary text-white');

        $(this).addClass('border border-primary bg-primary text-white');

        let id = $(this).data("id-mesa");
        let num_mesa = $(this).data("num-mesa");
        let url = currentURL + '/mesas/'+id;

        $("#mesa-id").val(id);
        $('#tituloModalCuenta').html('Mesa '+ num_mesa);
        $('#modalCuenta').modal({backdrop: 'static', keyboard: false});
        /**
         * recuperar el estatus de la mesa
         */
         $.get(url, function(data, textStatus, jqXHR) {
            /**
             * Ocupada
             *  1 = ocupada
             *  0 = no ocupada
             *
             * cuenta
             *  0 = Sin cuenta
             *  1 = Con cuenta
             */

            if ( data.cuenta == 0 && data.ocupada == 0 ) {
                $("#abrirCuenta").slideDown();
                $("#eliminarMesa").slideDown();
                $("#cerrarCuenta").slideUp();
                $("#saveCuenta").slideUp();
            } else {

                let id_mesa = $("#mesa-id").val();
                let url = currentURL + '/cuentas/'+id_mesa;

                $("#eliminarMesa").slideUp();
                $("#saveCuenta").slideDown();
                $("#abrirCuenta").slideUp();

                $.get(url, function(data, textStatus, xhr) {

                    $('#modal-body-cuenta').html(data);

                }).fail(function(data) {
                    printErrorMsg(data.responseJSON.errors);
                });

                $("#abrirCuenta").slideUp();
                $("#eliminarMesa").slideUp();
                $("#cerrarCuenta").slideDown();
                $("#saveCuenta").slideDown();
            }

        });
    });

       /**
     * Evento para eliminar el modulo
     */
        $(document).on('click', '#eliminarMesa', function(event) {
            event.preventDefault();
            Swal.fire({
                title: '¿Estas seguro?',
                text: "Deseas eliminar el registro seleccionado!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.value) {

                    let id = $("#mesa-id").val();
                    let _token = $("meta[name=csrf-token]").attr("content");
                    let _method = "DELETE";
                    let url = currentURL + '/mesas/' + id;

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _token: _token,
                            _method: _method
                        },
                        success: function(result) {
                            $('.viewResult').html(result);
                            $('.modal-backdrop ').css('display', 'none');
                            $('#modalCuenta').modal('hide');
                            $('#modal-body-cuenta').html('');
                            Swal.fire(
                                'Eliminado!',
                                'El registro ha sido eliminado.',
                                'success'
                            )
                        }
                    });
                }
            });
        });

        /**
     * Funcion para mostrar los errores de los formularios
     */
    function printErrorMsg(msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display', 'block');
        $(".form-control").removeClass('is-invalid');
        for (var clave in msg) {
            $("#" + clave).addClass('is-invalid');
            if (msg.hasOwnProperty(clave)) {
                $(".print-error-msg").find("ul").append('<li>' + msg[clave][0] + '</li>');
            }
        }
    }

});

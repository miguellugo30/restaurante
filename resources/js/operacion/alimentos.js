$(function() {

    let currentURL = window.location.href;

    $(document).on("click", ".newAlimentos", function(e) {
        e.preventDefault();
        $('#tituloModal').html('Nuevo Alimento');
        $('#action').removeClass('updateAlimento');
        $('#action').addClass('saveAlimento');

        let url = currentURL + '/alimentos/create';

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
        });

    });
    /**
     * Evento para guardar el nuevo modulo
     */
     $(document).on('click', '.saveAlimento', function(event) {
        event.preventDefault();

        let nombre = $("#nombre").val();
        let costo = $("#costo").val();
        var _token = $("meta[name=csrf-token]").attr("content");

        let url = currentURL + '/alimentos';

        $.post(url, {
            nombre: nombre,
            costo: costo,
            _token: _token
        }, function(data, textStatus, xhr) {

            $('.viewResult').html(data);
        }).done(function() {
            $('.modal-backdrop ').css('display', 'none');
            $('#modal').modal('hide');
            Swal.fire(
                'Correcto!',
                'El registro ha sido guardado.',
                'success'
            )
        }).fail(function(data) {
            printErrorMsg(data.responseJSON.errors);
        });
    });
    /**
     * Evento para mostrar el formulario editar modulo
     */
     $(document).on('click', '.alimentosTable tbody tr', function(event) {
        event.preventDefault();

        let id = $(this).data("id");
        $(".deleteAlimentos").slideDown();
        $(".editAlimentos").slideDown();

        $("#idSeleccionado").val(id);

        $(".alimentosTable tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });
    /**
     * Evento para mostrar el formulario de edicion de un canal
     */
     $(document).on("click", ".editAlimentos", function(e) {

        e.preventDefault();
        $('#tituloModal').html('Editar Alimento');
        $('#action').removeClass('saveAlimento');
        $('#action').addClass('updateAlimento');

        let id = $("#idSeleccionado").val();

        let url = currentURL + "/alimentos/" + id + "/edit";

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal-body").html(data);
        });
    });
    /**
     * Evento para guardar el nuevo modulo
     */
     $(document).on('click', '.updateAlimento', function(event) {
        event.preventDefault();

        let nombre = $("#nombre").val();
        let id = $("#idSeleccionado").val();
        let costo = $("#costo").val();
        var _token = $("meta[name=csrf-token]").attr("content");
        let _method = "PUT";

        let url = currentURL + '/alimentos/'+id;

        $.post(url, {
            nombre: nombre,
            costo: costo,
            _token: _token,
            _method:_method
        }, function(data, textStatus, xhr) {

            $('.viewResult').html(data);
        }).done(function() {
            $('.modal-backdrop ').css('display', 'none');
            $('#modal').modal('hide');
            Swal.fire(
                'Correcto!',
                'El registro ha sido actualizado.',
                'success'
            )
        }).fail(function(data) {
            printErrorMsg(data.responseJSON.errors);
        });
    });
    /**
     * Evento para eliminar el modulo
     */
     $(document).on('click', '.deleteAlimentos', function(event) {
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
                let id = $("#idSeleccionado").val();
                let _token = $("input[name=_token]").val();
                let _method = "DELETE";
                let url = currentURL + '/alimentos/' + id;

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: _token,
                        _method: _method
                    },
                    success: function(result) {
                        $('.viewResult').html(result);
                        $('.viewCreate').slideUp();
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

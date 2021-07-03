$(function() {

    let currentURL = window.location.href;

    $(document).on("click", "#abrirCuenta", function(e) {

        e.preventDefault();
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

    });

    $(document).on("change", ".tipoAlimento", function(e) {

        let id_tipo = $(this).val();
        let fila = $(this).data('fila');
        let url = currentURL + '/alimentos/'+id_tipo;

        console.log(id_tipo);

        if ( id_tipo != '' ) {
            $.get(url, function(data, textStatus, xhr) {

                $('#opcionTipo_'+fila).html(data);

            }).fail(function(data) {
                printErrorMsg(data.responseJSON.errors);
            });
        }else{
            $('#opcionTipo_'+fila).html('');
        }

    });

    $(document).on("change", ".cantidad", function(e) {

        let cantidad = $(this).val();
        let fila = $(this).data('fila');
        let costo = $("#opcionTipo_"+fila+" #producto option:selected").data('costo-alimento');

        console.log( fila+" "+cantidad+" "+costo);

        let total = cantidad * costo;

        $("#costo_"+fila).html( "$ " + total+".00");

    });

    $(document).on("click", "#cancelar", function(e) {
        $('#modal-body-cuenta').html('');
    });

    $(document).on("click", ".agregar", function(e) {

        let clickID = $("#newCuenta tbody tr.clonar:last").attr('id').replace('tr_', '');
        let newID = parseInt(clickID) + 1;
        let IDInput = ['tipoAlimento', 'opcionTipo', 'cantidad', 'costo', 'atendida'];


        fila = $("#newCuenta tbody tr:eq()").clone().appendTo("#newCuenta"); //Clonamos la fila
        fila.find('.tipoAlimento').attr('data-fila', newID);
        fila.find('.cantidad').attr('data-fila', newID);
        for (let i = 0; i < IDInput.length; i++) {
            fila.find('.' + IDInput[i]).attr('name', IDInput[i] + "_" + newID); //Cambiamos el nombre de los campos de la fila a clonar
            fila.find('.' + IDInput[i]).attr('id', IDInput[i] + "_" + newID); //Cambiamos el nombre de los campos de la fila a clonar
            fila.find('#cantidad_' + newID).val("");
            fila.find('#costo_' + newID).html("");
            fila.find('.tipoAlimento option').removeAttr('selected');
            fila.find('.opcionTipo option').removeAttr('selected');
        }

        fila.attr("id", 'tr_' + newID);
        console.log(clickID);

    });

    $(document).on("click", "#saveCuenta", function(e) {

        let dataForm = $("#formNewCuenta").serializeArray();
        let mesa_id = $("#mesa-id").val();
        let url = currentURL + '/cuentas/';
        var _token = $("meta[name=csrf-token]").attr("content");

        $.post(url, {
            mesa_id: mesa_id,
            dataForm: dataForm,
            _token: _token
        }, function(data, textStatus, xhr) {

            $('.viewResult').html(data);
        }).done(function() {
            $('.modal-backdrop ').css('display', 'none');
            $('#modalCuenta').modal('hide');
            $('#modal-body-cuenta').html('');
            Swal.fire(
                'Correcto!',
                'El registro ha sido guardado.',
                'success'
            )
        }).fail(function(data) {
            printErrorMsg(data.responseJSON.errors);
        });

    });

    $(document).on("click", "#comidaAtendida", function(e) {

        let cuenta_id = $(this).data('cuenta');
        let mesa_id = $(this).data('mesa');
        let url = currentURL + '/cocina/'+cuenta_id;
        var _token = $("meta[name=csrf-token]").attr("content");

        $.post(url, {
            mesa_id: mesa_id,
            cuenta_id: cuenta_id,
            _token: _token,
            _method: 'PUT'
        }, function(data, textStatus, xhr) {

            $('.viewResult').html(data);
        }).done(function() {
            Swal.fire(
                'Correcto!',
                'El registro ha sido guardado.',
                'success'
            )
        }).fail(function(data) {
            printErrorMsg(data.responseJSON.errors);
        });

    });

    $(document).on("click", "#cerrarCuenta", function(e) {

        let mesa_id = $("#mesa-id").val();
        let url = currentURL + '/mesas/'+mesa_id;
        var _token = $("meta[name=csrf-token]").attr("content");

        $.post(url, {
            mesa_id: mesa_id,
            _token: _token,
            _method: 'PUT'
        }, function(data, textStatus, xhr) {
            $('.modal-backdrop ').css('display', 'none');
                            $('#modalCuenta').modal('hide');
                            $('#modal-body-cuenta').html('');
            $('.viewResult').html(data);
        }).done(function() {
            Swal.fire(
                'Correcto!',
                'El registro ha sido guardado.',
                'success'
            )
        }).fail(function(data) {
            printErrorMsg(data.responseJSON.errors);
        });

    });



});

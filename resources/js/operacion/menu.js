$(function() {

    let timerListAgente = '';
    let currentURL = window.location.href;
    /**
     * Evento para el menu de sub categorias y mostrar la vista
     */
    $(document).on("click", ".menu", function(e) {
        e.preventDefault();
        stop(timerListAgente);
        let id = $(this).data("menu");

        if (id == 'mesas')
        {
            url = currentURL + '/mesas';
            $("#title").html('Mesas')
        }
        else if (id == 'alimentos')
        {
            url = currentURL + '/alimentos';
            $("#title").html('Alimentos')
        }
        else if (id == 'bebidas')
        {
            url = currentURL + '/bebidas';
            $("#title").html('Bebidas')
        }
        else if (id == 'meseros')
        {
            url = currentURL + '/meseros';
            $("#title").html('Meseros')
        }
        else if (id == 'cuentas')
        {
            url = currentURL + '/cuentas/0/edit';
            $("#title").html('Meseros')
        }
        else if (id == 'cocina')
        {

            url = currentURL + '/cocina';
            $("#title").html('Cocina')
            start(url);

        }

        if ( id != 'cocina' )
        {
            stop(timerListAgente);
        }


        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewResult").html(data);

        });
    });

    function stop(timer) {
        clearInterval(timer);
    };

    function start(url) { //use a one-off timer
        /**
         * Función para actualizar el listado de agentes
         * para poder obtener el estado de los agentes
         */
        timerListAgente = setInterval(function() {
            $.get(url, function(data, textStatus, jqXHR) {
                $(".viewResult").html(data);
            });
        }, 5000);
    }

});

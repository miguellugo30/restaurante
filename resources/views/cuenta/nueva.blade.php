<div class="col">
    <h4 class="float-left">Nueva Cuenta</h4>
    <button type="button" class="btn btn-primary float-right btn-sm agregar">Agregar</button>
</div>
<form id="formNewCuenta">
    <table class="table" id="newCuenta">
        <thead class="thead-light">
            <tr>
                <th>Tipo</th>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Costo</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr id="tr_1" class="clonar">
                <td>
                    <select name="tipoAlimento_1" id="tipoAlimento_1" class="form-control form-control-sm tipoAlimento" data-fila="1">
                        <option value="">Selecciona una opción</option>
                        <option value="1">Alimentos</option>
                        <option value="2">Bebidas</option>
                    </select>
                </td>
                <td>
                    <div id="opcionTipo_1" name="opcionTipo_1" class="opcionTipo"></div>
                </td>
                <td>
                    <input type="number" name="cantidad_1" id="cantidad_1" class="form-control form-control-sm cantidad" data-fila="1" size="3" min="1">
                    <input type="hidden" name="atendida_1" id="atendida_1" class="form-control form-control-sm cantidad" data-fila="1" value="0">
                </td>
                <td>
                    <div id="costo_1" class="costo" name="costo_1"></div>
                </td>
                <td></td>
            </tr>
        </tbody>
    </table>
</form>

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
            @php
                $i = 1;
            @endphp

            @foreach ($cuenta->Alimentos as $e)

                <tr id="tr_{{ $i }}" class="clonar">
                    <td>
                        <select name="tipoAlimento_{{ $i }}" id="tipoAlimento_{{ $i }}" class="form-control form-control-sm tipoAlimento" data-fila="{{ $i }}">
                            <option value="">Selecciona una opción</option>
                            <option {{ $e->tipo == 1 ? 'selected' : '' }} value="1">Alimentos</option>
                            <option {{ $e->tipo == 2 ? 'selected' : '' }} value="2">Bebidas</option>
                        </select>
                    </td>
                    <td>
                        <div id="opcionTipo_{{ $i }}" name="opcionTipo_{{ $i }}" class="opcionTipo">
                            <select name="producto" id="producto" class="form-control form-control-sm" >
                                <option value="">Selecciona una opción</option>
                                @foreach ($alimentos->where( 'tipo',  $e->tipo) as $a)
                                    <option {{ $e->pivot->alimentos_id == $a->id ? 'selected' : '' }} value="{{ $a->id }}" data-costo-alimento="{{$a->costo}}">{{ $a->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </td>
                    <td>
                        <input type="number" name="cantidad_{{ $i }}" id="cantidad_{{ $i }}" class="form-control form-control-sm cantidad" value="{{ $e->pivot->cantidad }}" data-fila="{{ $i }}" size="3" min="1">
                        <input type="hidden" name="atendida_{{ $i }}" id="atendida_{{ $i }}" class="form-control form-control-sm atendida" data-fila="1" value="{{ $e->pivot->atendido }}">
                    </td>
                    <td>
                        <div id="costo_{{ $i }}" class="costo" name="costo_{{ $i }}">$ {{ number_format( ($e->pivot->cantidad * $e->costo), 2 ) }}</div>
                    </td>
                    <td></td>
                </tr>
                @php
                    $i++;
                @endphp
            @endforeach

        </tbody>
    </table>
</form>


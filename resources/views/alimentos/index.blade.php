<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-utensils"></i>
            Alimentos
          </h3>
          <div class="card-tools">
                <button type="button" class="btn btn-danger btn-sm deleteAlimentos" style="display:none"><i class="fas fa-trash-alt"></i> Elminar</button>
                <button type="button" class="btn btn-warning btn-sm editAlimentos" style="display:none"><i class="fas fa-edit"></i> Editar</button>
                <button type="button" class="btn btn-primary btn-sm newAlimentos"><i class="fas fa-plus"></i> Nuevo</button>
                <input type="hidden" name="idSeleccionado" id="idSeleccionado" value="">
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped table-sm alimentosTable">
            <thead class="thead-light">
                <tr>
                    <th>Nombre</th>
                    <th>Costo</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($alimentos as $a)
                    <tr data-id="{{ $a->id }}">
                        <td>{{ $a->nombre }}</td>
                        <td>$ {{ number_format( $a->costo, 2 ) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center">

                            <p>Sin información</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>



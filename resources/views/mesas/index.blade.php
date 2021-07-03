<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-comment-dots"></i>
            Mesas
          </h3>
          <div class="card-tools">
                <button type="button" class="btn btn-danger btn-sm deleteMesa" style="display:none"><i class="fas fa-trash-alt"></i> Elminar</button>
                <button type="button" class="btn btn-primary btn-sm newMesa"><i class="fas fa-plus"></i> Nueva</button>
                <input type="hidden" name="idSeleccionado" id="idSeleccionado" value="">
        </div>
    </div>
    <div class="card-body">
        <div class="row row-cols-2">
            @foreach ($mesas as $m)
                <div class="col">
                    <div class="jumbotron jumbotron-fluid mesa {{  $m->ocupada == 1 ? 'bg-info' : '' }} " data-id-mesa="{{ $m->id }}" data-num-mesa="{{ $m->num_mesa }}">
                        <div class="container text-center">
                            <h4>Mesa {{$m->num_mesa}}</h4>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

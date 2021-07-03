<div class="col">
    <div class="form-group">
        <label for="nombre">Nombre *:</label>
        <input type="text" class="form-control form-control-sm" id="nombre" placeholder="Nombre" value="{{$alimento->nombre}}">
    </div>
    <div class="form-group">
        <label for="nombre">Costo ($) *:</label>
        <input type="number" class="form-control form-control-sm" id="costo" placeholder="Costo" value="{{$alimento->costo}}">
    </div>
    <div class="form-group">
        <small class="form-text text-muted"> <b>*Campos obligatorios.</b></small>
    </div>
    <div class="alert alert-danger print-error-msg" role="alert" style="display:none">
        <ul></ul>
    </div>
</div>

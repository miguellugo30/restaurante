<select name="producto" id="producto" class="form-control form-control-sm" >
    <option value="">Selecciona una opción</option>
    @foreach ($alimentos as $a)
        <option value="{{ $a->id }}" data-costo-alimento="{{$a->costo}}">{{ $a->nombre }}</option>
    @endforeach
</select>

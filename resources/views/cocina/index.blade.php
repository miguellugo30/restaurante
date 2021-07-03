<div class="row row-cols-4">
    @foreach ($mesas as $c)
        <div class="col">
            <div class="card text-white bg-info mb-3" style="width: 18rem;">
                <div class="card-header font-weight-bold">Mesa {{ $c->first()->mesas_id }} </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush bg-info">

                        @foreach ($c as $a)
                            <li class="list-group-item bg-info"> {{ $a->cantidad }}  {{ $a->nombre }}</li>
                        @endforeach

                    </ul>
                </div>
                <div class="card-footer ">
                    @php
                        $fechaPedido = \Carbon\Carbon::parse( $c->first()->created_at );
                        $fechaActual = \Carbon\Carbon::parse( date('Y-m-d H:i:s') );
                    @endphp
                    {{ $fechaActual->diffForHumans( $fechaPedido ) }}
                    <a id="comidaAtendida"  data-mesa="{{ $c->first()->mesas_id }}" data-cuenta="{{ $c->first()->id }}" class="btn btn-primary float-right">Atendida</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

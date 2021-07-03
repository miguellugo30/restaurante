<?php

namespace App\Http\Controllers;

use App\Models\CuentasModel;
use App\Models\MesasModel;
use Illuminate\Http\Request;

class MesasController extends Controller
{

    private $mesas;
    private $cuenta;

    public function __construct(MesasModel $mesas, CuentasModel $cuenta)
    {
        $this->mesas = $mesas;
        $this->cuenta = $cuenta;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $mesas = $this->mesas->active()->get();
        return view('mesas.index', compact('mesas'));

    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('creditocobranza::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $mesa = $this->mesas::active()->orderBy('num_mesa', 'desc')->limit(1)->first();

        if ( $mesa == NULL )
        {
            $n = 1;
        }
        else
        {
            $n = ( $mesa->num_mesa + 1 );
        }



        $this->mesas::create([
            'ocupada' => 0,
            'activo' => 1,
            'num_mesa' => $n
        ]);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('mesas.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $mesa = $this->mesas::select('ocupada')->where('id', $id)->first();
        $cuenta = $this->cuenta::where('mesas_id', $id)->whereNull('fecha_cierre')->first();


        if ( $cuenta == NULL )
        {
            $c = 0;
        }
        else
        {
            $c = 1;
        }

        return response()->json(['ocupada' => $mesa->ocupada, 'cuenta' => $c]);

    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {


    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->mesas::where('id', $id)->
                        update([
                            'ocupada' => 0
                        ]);

        $this->cuenta::where('mesas_id', $id)->whereNull('fecha_cierre')->
        update([
            'fecha_cierre' => date('Y-m-d H:i:s')
        ]);

        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('mesas.index');


    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->mesas::where('id', $id)->
        update([
            'activo' => 0
        ]);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('mesas.index');
    }
}

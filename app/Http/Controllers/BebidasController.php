<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlimentosRequest;
use App\Models\AlimentosModel;
use Illuminate\Http\Request;

class BebidasController extends Controller
{
    private $bebidas;

    public function __construct(AlimentosModel $bebidas)
    {
        $this->bebidas = $bebidas;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bebidas = $this->bebidas->where('tipo', 2)->active()->get();

        return view('bebidas.index', compact('bebidas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bebidas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlimentosRequest $request)
    {
        $this->bebidas::create([
            'nombre' => $request->nombre,
            'costo' => $request->costo,
            'tipo' => 2,
        ]);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('bebidas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bebida = $this->bebidas->where('id', $id)->first();

        return view('bebidas.edit', compact('bebida'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->bebidas::where('id', $id)->
        update([
            'nombre' => $request->nombre,
            'costo' => $request->costo

        ]);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('bebidas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->bebidas::where('id', $id)->
        update([
            'activo' => 0
        ]);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('bebidas.index');
    }
}

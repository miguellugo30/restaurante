<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlimentosRequest;
use App\Models\AlimentosModel;
use Illuminate\Http\Request;

class AlimentosController extends Controller
{
    private $alimentos;

    public function __construct(AlimentosModel $alimentos)
    {
        $this->alimentos = $alimentos;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alimentos = $this->alimentos->where('tipo', 1)->active()->get();

        return view('alimentos.index', compact('alimentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alimentos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlimentosRequest $request)
    {
        $this->alimentos::create([
            'nombre' => $request->nombre,
            'costo' => $request->costo,
            'tipo' => 1,
        ]);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('alimentos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alimentos = $this->alimentos::where('tipo', $id)->get();

        return view('alimentos.show', compact('alimentos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alimento = $this->alimentos->where('id', $id)->first();

        return view('alimentos.edit', compact('alimento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AlimentosRequest $request, $id)
    {
        $this->alimentos::where('id', $id)->
        update([
            'nombre' => $request->nombre,
            'costo' => $request->costo

        ]);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('alimentos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->alimentos::where('id', $id)->
        update([
            'activo' => 0
        ]);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('alimentos.index');
    }

}

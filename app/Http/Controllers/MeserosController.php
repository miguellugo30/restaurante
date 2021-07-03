<?php

namespace App\Http\Controllers;

use App\Http\Requests\MeserosRequest;
use App\Models\MeserosModel;
use Illuminate\Http\Request;

class MeserosController extends Controller
{
    private $meseros;

    public function __construct(MeserosModel $meseros)
    {
        $this->meseros = $meseros;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meseros = $this->meseros::active()->get();

        return view('meseros.index', compact('meseros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('meseros.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MeserosRequest $request)
    {
        $this->meseros::create(['nombre' => $request->nombre]);

        return redirect()->route('meseros.index');

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
        $mesero = $this->meseros::where('id', $id)->first();

        return view('meseros.edit', compact('mesero'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MeserosRequest $request, $id)
    {
        $this->meseros::where('id', $id)->
        update([
            'nombre' => $request->nombre

        ]);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('meseros.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->meseros::where('id', $id)->
        update([
            'activo' => 0
        ]);
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('meseros.index');
    }
}

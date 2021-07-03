<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlimentosModel;
use App\Models\CuentasModel;
use App\Models\MesasModel;
use Illuminate\Support\Facades\DB;

class CocinaController extends Controller
{
    private $cuenta;
    private $mesas;
    private $alimentos;

    public function __construct(CuentasModel $cuenta, MesasModel $mesas, AlimentosModel $alimentos)
    {
        $this->cuenta = $cuenta;
        $this->mesas = $mesas;
        $this->alimentos = $alimentos;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuentas = DB::table('alimentos')
                        ->join('cuentas_alimentos', 'alimentos.id', '=', 'cuentas_alimentos.alimentos_id')
                        ->join('cuenta', 'cuentas_alimentos.cuentas_id', '=', 'cuenta.id')
                        ->select(
                                'cuenta.mesas_id',
                                'alimentos.nombre',
                                'cuentas_alimentos.cantidad',
                                'cuentas_alimentos.created_at',
                                'cuenta.id'
                            )
                        ->where('alimentos.tipo', 1)
                        ->where('cuentas_alimentos.atendido', 0)
                        ->get();

        $mesas = $cuentas->groupBy('mesas_id');

        return view('cocina.index', compact('mesas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        /**
         * Actualizamos los alimentos como atendidos
         * realacionados a la mesa y a la cuenta
         */

        DB::table('cuentas_alimentos')
            ->where('cuentas_id', $id)
            ->update([
                            'atendido' => 1,
                            'updated_at' => date('Y-m-d H:i:s')
                    ]);

        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('cocina.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

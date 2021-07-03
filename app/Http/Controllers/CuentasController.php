<?php

namespace App\Http\Controllers;

use App\Models\AlimentosModel;
use App\Models\CuentasModel;
use App\Models\MesasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CuentasController extends Controller
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
        $mesa = $this->mesas::select('ocupada')->where('id', $request->mesa_id)->first();



        if ( $mesa->ocupada == 1 )
        {
            $this->updateCuenta($request->mesa_id, $request->dataForm);
        }
        else
        {
            $this->createCuenta($request->mesa_id, $request->dataForm);
        }
        /**
         * Redirigimos a la ruta index
         */
        return redirect()->route('mesas.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cuenta = $this->cuenta::where('mesas_id', $id)->whereNull('fecha_cierre')->first();

        if ( $cuenta == NULL )
        {
            return view('cuenta.nueva');
        }
        else
        {
            $alimentos = $this->alimentos::active()->get();

            return view('cuenta.abierta', compact('cuenta', 'alimentos'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cuentas = $this->cuenta::get();

        return view('cuenta.show', compact('cuentas'));
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
        //
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

    public function updateCuenta($mesa_id, $dataForm)
    {
        /**
         * Recuperamos la cuenta de la mesa
         */
        $cuenta = $this->cuenta->where('mesas_id', $mesa_id)->whereNull('fecha_cierre')->first();
        //$cuenta->Alimentos()->detach();
        $this->asociarAlimentos($cuenta, $dataForm);
    }

    public function createCuenta($mesa_id, $dataForm)
    {
        /**
         * Poner la mesa como ocupada
         **/
        $this->mesas::where('id', $mesa_id)->
        update([
            'ocupada' => 1
        ]);
        /*+
         * Creamos la nueva cuenta
         **/
        $cuenta = $this->cuenta::create([
            'total' => 0,
            'fecha_apertura' => date("Y-m-d H:i:s"),
            'meseros_id' => 1,
            'mesas_id' => $mesa_id
        ]);

        $this->asociarAlimentos($cuenta, $dataForm);

    }

    public function asociarAlimentos($cuenta, $dataForm)
    {
        $data = array_chunk( $dataForm, 4);
        $total = 0;

        for ($i=0; $i < count($data); $i++)
        {
            $e = $data[$i];

            $cantidad = $e[2]['value'];
            $alimento = $e[1]['value'];

            $existe = DB::table('cuentas_alimentos')
                        ->where('cuentas_id', $cuenta->id)
                        ->where('alimentos_id', $alimento)
                        ->where('cantidad', $cantidad)
                        ->exists();

            if ( !$existe )
            {
                $cuenta->Alimentos()->attach($alimento, ['cantidad' => $cantidad, 'created_at' => date('Y-m-d H:i:s') ]);
                $a = $this->alimentos::where('id', $alimento)->first();
                $total = $total + ( $a->costo * $cantidad ) + $cuenta->total;
            }
        }

        $this->cuenta::where( 'id', $cuenta->id )
                    ->update([
                        'total' => $total
                    ]);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuentasModel extends Model
{
    use HasFactory;
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'total', 'fecha_apertura', 'fecha_cierre', 'meseros_id', 'mesas_id'
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'cuenta';
    /**
     * Funcion para obtener solo los registros activos
     */
    public function scopeActive($query)
    {
        return $query->where('activo', 1);
    }
    /*
    |--------------------------------------------------------------------------
    | RELACIONES DE BASE DE DATOS
    |--------------------------------------------------------------------------
    */
    /**
     * Relacion muchos a uno con meseros
     */
    public function Meseros()
    {
        return $this->belongsTo(MeserosModel::class, 'meseros_id', 'id');
    }
    /**
     * Relacion muchos a uno con mesas
     */
    public function Mesas()
    {
        return $this->belongsTo(MesasModel::class, 'mesas_id', 'id');
    }
    /**
     * Relacion muchos a muchos con alimentos
     */
    public function Alimentos()
    {
        return $this->belongsToMany(AlimentosModel::class, 'cuentas_alimentos', 'cuentas_id', 'alimentos_id')->withPivot('cantidad')->withPivot('atendido');
    }
}

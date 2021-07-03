<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlimentosModel extends Model
{
    use HasFactory;
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'nombre', 'costo', 'activo', 'tipo'
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'alimentos';
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
     * Relacion muchos a muchos con alimentos
     */
        /**
     * Relacion muchos a muchos con alimentos
     */
    public function Cuentas()
    {
        return $this->belongsToMany(CuentasModel::class, 'cuentas_alimentos', 'alimentos_id', 'cuentas_id')->withPivot('cantidad')->withPivot('atendido');
    }
}

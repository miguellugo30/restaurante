<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MesasModel extends Model
{
    use HasFactory;

    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'ocupada', 'activo', 'num_mesa'
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'mesas';
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
    public function Cuentas()
    {
        return $this->hasMany(CuentasModel::class, 'mesas_id', 'id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeserosModel extends Model
{
    use HasFactory;

    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'nombre', 'activo'
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'meseros';
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
        return $this->hasMany(CuentasModel::class, 'meseros_id', 'id');
    }
}

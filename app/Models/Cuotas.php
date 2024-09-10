<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuotas extends Model
{
    protected $table = 'cuotas';

    protected $fillable = [
        'PrestamoID',
        'FechaPago',
        'MontoCuota',
        'Estado',
    ];

    // Relación con el modelo Prestamos
    public function prestamo()
    {
        return $this->belongsTo(Prestamos::class, 'PrestamoID');
    }

    // Relación con el modelo Cobros (si tienes uno)
    public function cobros()
{
    return $this->hasMany(Cobros::class, 'CuotaID');
}

}
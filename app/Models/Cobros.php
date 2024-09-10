<?php

// app/Models/Cobros.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cobros extends Model
{
    use HasFactory;

    protected $table = 'cobros'; // Nombre de la tabla en la base de datos

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'CuotaID',
        'FechaCobro',
        'MontoCobrado',
    ];

    // Relación con el modelo Cuotas
    public function cuota()
    {
        return $this->belongsTo(Cuotas::class, 'CuotaID');
    }
}


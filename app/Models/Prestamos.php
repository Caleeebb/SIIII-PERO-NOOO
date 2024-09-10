<?php

// app/Models/Prestamos.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestamos extends Model
{
    // Define la tabla si no sigue la convención
    protected $table = 'prestamos';

    // Campos que se pueden asignar de manera masiva
    protected $fillable = [
        'ClienteID', 'MontoPrestamo', 'Interes', 'NumeroCuotas', 
        'FormaPago', 'FechaEmision', 'Estado'
    ];

    // Definir la relación muchos a uno con Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'ClienteID');
    }

    // Relación con el modelo Cuotas
    public function cuotas()
{
    return $this->hasMany(Cuotas::class, 'PrestamoID');
}
}

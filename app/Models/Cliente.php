<?php

// app/Models/Cliente.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    // Define la tabla si no sigue la convención
    protected $table = 'clientes';

    // Campos que se pueden asignar de manera masiva
    protected $fillable = [
        'DNI', 'Nombre', 'Apellido', 'Genero', 'FechaNacimiento', 
        'Direccion', 'Telefono', 'CorreoElectronico'
    ];

    // Definir la relación uno a muchos con Prestamos
    public function prestamo()
    {
        return $this->hasMany(Prestamos::class, 'ClienteID');
    }
}


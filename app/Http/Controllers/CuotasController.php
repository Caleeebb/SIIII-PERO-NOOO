<?php

namespace App\Http\Controllers;

use App\Models\Cobros;
use Illuminate\Http\Request;
use App\Models\Cuotas;
use App\Models\Prestamos;

class CuotasController extends Controller
{
    // Listar todas las cuotas
    public function index()
    {
        $cuotas = Cuotas::with('prestamo')->get(); // Cargar el préstamo relacionado
        return view('cuotas.index', compact('cuotas'));
    }

    // Mostrar el formulario para crear una nueva cuota
    public function create()
    {
        $prestamos = Prestamos::all(); // Obtener todos los préstamos para asignar la cuota
        return view('cuotas.create', compact('prestamos'));
    }

    // Guardar una nueva cuota en la base de datos
    public function store(Request $request)
    {
        // Validación de los datos recibidos
        $request->validate([
            'PrestamoID' => 'required|exists:prestamos,id',
            'FechaPago' => 'required|date',
            'MontoCuota' => 'required|numeric|min:0',
            'Estado' => 'required|in:pagado,pendiente',
        ]);

        // Creación de la cuota en la base de datos
        Cuotas::create($request->all());

        // Redirigir al usuario a la lista de cuotas con un mensaje de éxito
        return redirect()->route('cuotas.index')->with('success', 'Cuota agregada exitosamente.');
    }

    // Mostrar el formulario para editar una cuota existente
    public function edit($id)
    {
        $cuota = Cuotas::findOrFail($id);
        $prestamos = Prestamos::all();
        return view('cuotas.edit', compact('cuota', 'prestamos'));
    }

    // Actualizar una cuota en la base de datos
    public function update(Request $request, $id)
    {
        $cuota = Cuotas::findOrFail($id);

        // Validación de los datos recibidos
        $request->validate([
            'PrestamoID' => 'required|exists:prestamos,id',
            'FechaPago' => 'required|date',
            'MontoCuota' => 'required|numeric|min:0',
            'Estado' => 'required|in:pagado,pendiente',
        ]);

        // Actualización de la cuota en la base de datos
        $cuota->update($request->all());

        return redirect()->route('cuotas.index')->with('success', 'Cuota actualizada exitosamente.');
    }

    // Eliminar una cuota de la base de datos
    public function destroy($id)
    {
        $cuota = Cuotas::findOrFail($id);
        $cuota->delete();

        return redirect()->route('cuotas.index')->with('success', 'Cuota eliminada exitosamente.');
    }

    public function procesarPago(Request $request)
{
    $cuota = Cuotas::findOrFail($request->input('cuota_id'));

    // Crear el registro de cobro
    Cobros::create([
        'CuotaID' => $cuota->id,
        'MontoCobrado' => $request->input('MontoCobrado'),
        'FechaCobro' => $request->input('FechaCobro'),
    ]);

    // Actualizar el estado de la cuota y el préstamo
    if ($cuota->montoRestante() <= 0) {
        $cuota->update(['Estado' => 'Cancelado']);
    }

    // Redirigir de vuelta al detalle del préstamo
    return redirect()->route('prestamos.show', $cuota->PrestamoID)
        ->with('success', 'Cuota pagada exitosamente.');
}

}

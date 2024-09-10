<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cobros;
use App\Models\Cuotas;
use App\Models\Prestamos; // Asegúrate de importar eal modelo Prestamos

class CobrosController extends Controller
{
    // Mostrar el formulario para registrar un nuevo cobro
    public function create()
    {
        $cuotas = Cuotas::all(); // Obtener todas las cuotas disponibles
        return view('cobros.create', compact('cuotas'));
    }

    // Guardar un nuevo cobro en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'CuotaID' => 'required|exists:cuotas,id',
            'FechaCobro' => 'required|date',
            'MontoCobrado' => 'required|numeric|min:0',
        ]);

        // Crear el cobro
        Cobros::create([
            'CuotaID' => $request->CuotaID,
            'FechaCobro' => $request->FechaCobro,
            'MontoCobrado' => $request->MontoCobrado,
        ]);

        // Actualizar el estado de la cuota
        $cuota = Cuotas::findOrFail($request->CuotaID);
        if ($cuota->MontoCuota <= $request->MontoCobrado) {
            $cuota->Estado = 'Cancelado';
            $cuota->save();
        }

        // Verificar si todas las cuotas del préstamo están pagadas
        $prestamo = $cuota->prestamo;
        $cuotasPendientes = $prestamo->cuotas()->where('Estado', 'Pendiente')->count();

        if ($cuotasPendientes === 0) {
            $prestamo->Estado = 'Cancelado';
            $prestamo->save();
        }

        return redirect()->route('cobros.index')->with('success', 'Cobro registrado exitosamente.');
    }

    // Mostrar todos los cobros
    public function index()
    {
        $cobros = Cobros::with('cuota')->get(); // Eager loading para obtener los datos de cuota
        return view('cobros.index', compact('cobros'));
    }

    // Mostrar el formulario para editar un cobro
    public function edit($id)
    {
        $cobro = Cobros::findOrFail($id);
        $cuotas = Cuotas::all(); // Obtener todas las cuotas disponibles
        return view('cobros.edit', compact('cobro', 'cuotas'));
    }

    // Actualizar un cobro en la base de datos
    public function update(Request $request, $id)
    {
        $request->validate([
            'CuotaID' => 'required|exists:cuotas,id',
            'FechaCobro' => 'required|date',
            'MontoCobrado' => 'required|numeric|min:0',
        ]);

        // Actualizar el cobro
        $cobro = Cobros::findOrFail($id);
        $cobro->update([
            'CuotaID' => $request->CuotaID,
            'FechaCobro' => $request->FechaCobro,
            'MontoCobrado' => $request->MontoCobrado,
        ]);

        // Actualizar el estado de la cuota
        $cuota = Cuotas::findOrFail($request->CuotaID);
        if ($cuota->MontoCuota <= $request->MontoCobrado) {
            $cuota->Estado = 'Cancelado';
            $cuota->save();
        }

        // Verificar si todas las cuotas del préstamo están pagadas
        $prestamo = $cuota->prestamo;
        $cuotasPendientes = $prestamo->cuotas()->where('estado', 'Pendiente')->count();

        if ($cuotasPendientes === 0) {
            $prestamo->Estado = 'Cancelado';
            $prestamo->save();
        }

        return redirect()->route('cobros.index')->with('success', 'Cobro actualizado exitosamente.');
    }

    // Eliminar un cobro
    public function destroy($id)
    {
        $cobro = Cobros::findOrFail($id);
        $cobro->delete();

        return redirect()->route('cobros.index')->with('success', 'Cobro eliminado exitosamente.');
    }
}

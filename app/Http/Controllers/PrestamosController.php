<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Models\Prestamos;
use App\Models\Cuotas;
use App\Models\Cobros;

class PrestamosController extends Controller
{
    // Listar todos los préstamos
    public function index()
    {
        $prestamos = Prestamos::with('cliente')->get(); // Cargar el cliente relacionado
        return view('prestamos.index', compact('prestamos'));
    }

    // Mostrar el formulario para crear un nuevo préstamo
    public function create()
    {
        $clientes = Cliente::all(); // Obtener todos los clientes para asignar el préstamo
        return view('prestamos.create', compact('clientes'));
    }

    // Guardar un nuevo préstamo en la base de datos
    public function store(Request $request)
    {
        // Validación de los datos recibidos
        $request->validate([
            'ClienteID' => 'required|exists:clientes,id',
            'MontoPrestamo' => 'required|numeric|min:0',
            'Interes' => 'required|numeric|min:0',
            'NumeroCuotas' => 'required|integer|min:1',
            'FormaPago' => 'required|string',
            'FechaEmision' => 'required|date',
            'Estado' => 'required|in:Pendiente,Cancelado',
        ]);
    
        // Creación del préstamo en la base de datos
        Prestamos::create($request->all());
    
        // Redirigir al usuario a la lista de préstamos con un mensaje de éxito
        return redirect()->route('prestamos.index')->with('success', 'Préstamo agregado exitosamente.');
    }

    // Mostrar los detalles de un préstamo incluyendo las cuotas y pagos
    public function show($id)
    {
        $prestamo = Prestamos::with(['cliente', 'cuotas.cobros'])->findOrFail($id);

        return view('prestamos.show', compact('prestamo'));
    }

    // Mostrar el formulario para editar un préstamo existente
    public function edit($id)
    {
        $prestamo = Prestamos::findOrFail($id);
        $clientes = Cliente::all();
        return view('prestamos.edit', compact('prestamo', 'clientes'));
    }

    // Actualizar un préstamo en la base de datos
    public function update(Request $request, $id)
    {
        $prestamo = Prestamos::findOrFail($id);

        // Validación de los datos recibidos
        $request->validate([
            'ClienteID' => 'required|exists:clientes,id',
            'MontoPrestamo' => 'required|numeric|min:0',
            'Interes' => 'required|numeric|min:0',
            'NumeroCuotas' => 'required|integer|min:1',
            'FormaPago' => 'required|string',
            'FechaEmision' => 'required|date',
            'Estado' => 'required|in:activo,finalizado',
        ]);

        // Actualización del préstamo en la base de datos
        $prestamo->update($request->all());

        return redirect()->route('prestamos.index')->with('success', 'Préstamo actualizado exitosamente.');
    }

    // Eliminar un préstamo de la base de datos
    public function destroy($id)
    {
        $prestamo = Prestamos::findOrFail($id);
        $prestamo->delete();

        return redirect()->route('prestamos.index')->with('success', 'Préstamo eliminado exitosamente.');
    }

    // Realizar un pago de una cuota
    public function pagarCuota(Request $request, $cuota_id)
    {
        // Validación de los datos recibidos
        $request->validate([
            'MontoCobrado' => 'required|numeric|min:0',
            'FechaCobro' => 'required|date',
        ]);

        // Obtener la cuota correspondiente
        $cuota = Cuotas::findOrFail($cuota_id);

        // Crear el cobro en la base de datos
        Cobros::create([
            'CuotaID' => $cuota->id,
            'MontoCobrado' => $request->MontoCobrado,
            'FechaCobro' => $request->FechaCobro,
        ]);

        // Actualizar el estado de la cuota si es necesario
        if ($cuota->montoRestante() <= 0) {
            $cuota->update(['Estado' => 'pagado']);
        }

        return redirect()->route('prestamos.show', $cuota->PrestamoID)->with('success', 'Pago realizado exitosamente.');
    }
}

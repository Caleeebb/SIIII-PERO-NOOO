<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Cobros; // Asegúrate de importar el modelo
use App\Models\Prestamos;

class ClienteController extends Controller
{
    // Mostrar la lista de clientes
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    // Mostrar el formulario para crear un nuevo cliente
    public function create()
    {
        return view('clientes.create');
    }

    // Guardar un nuevo cliente en la base de datos
    public function store(Request $request)
    {
        // Validación de los datos recibidos
        $request->validate([
            'DNI' => 'required|string|max:20|unique:clientes,DNI',
            'Nombre' => 'required|string|max:255',
            'Apellido' => 'required|string|max:255',
            'FechaNacimiento' => 'required|date',
            'Direccion' => 'nullable|string|max:255',
            'Telefono' => 'nullable|string|max:20',
            'CorreoElectronico' => 'required|email|max:255|unique:clientes,CorreoElectronico',
        ]);

        // Creación del cliente en la base de datos
        Cliente::create([
            'DNI' => $request->DNI,
            'Nombre' => $request->Nombre,
            'Apellido' => $request->Apellido,
            'FechaNacimiento' => $request->FechaNacimiento,
            'Direccion' => $request->Direccion,
            'Telefono' => $request->Telefono,
            'CorreoElectronico' => $request->CorreoElectronico,
        ]);

        // Redirigir al usuario a la lista de clientes con un mensaje de éxito
        return redirect()->route('clientes.index')->with('success', 'Cliente agregado exitosamente.');
    }


    // Mostrar los detalles de un cliente específico
   // app/Http/Controllers/ClienteController.php

public function show($id)
{
    $cliente = Cliente::findOrFail($id);
    $prestamos = $cliente->prestamos; // Obtener todos los préstamos del cliente

    return view('clientes.show', compact('cliente', 'prestamos'));
}


    // Mostrar el formulario para editar un cliente existente
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    // Actualizar un cliente en la base de datos
    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->nombre = $request->Nombre;
        $cliente->CorreoElectronico = $request->CorreoElectronico;
        // Otros campos
        $cliente->save();

        return redirect()->route('clientes.index');
    }

    // Eliminar un cliente de la base de datos
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('clientes.index');
    }

    public function mostrarAmortizacion($id)//Recibir el Id del cliente para buscar si tiene un prestamo
    {
        $prestamo = Prestamos::with('cuotas.cobros')->findOrFail($id); // Cargar el préstamo con sus cuotas y cobros
        $cuotas = $prestamo->cuotas;
    
        // Variables iniciales
        $montoPrestamo = $prestamo->MontoPrestamo;
        $tasaInteresAnual = 0.1; // 10% de interés anual
        $tasaInteresMensual = $tasaInteresAnual / 12;
        $saldoRestante = $montoPrestamo;
        $amortizacion = [];
    
        foreach ($cuotas as $index => $cuota) {
            // Cálculo del interés y capital
            $interes = $saldoRestante * $tasaInteresMensual;
            $capital = $cuota->MontoCuota - $interes;
    
            // Sumar los cobros realizados para la cuota actual
            $pagoRealizado = $cuota->cobros->sum('MontoCobrado');
            $saldoRestante -= $capital;
    
            // Ajuste por pagos realizados
            $saldoRestante += $pagoRealizado;
    
            // Guardar los detalles de la amortización
            $amortizacion[] = [
                'numero' => $index + 1,
                'fecha_pago' => $cuota->FechaPago,
                'monto_cuota' => $cuota->MontoCuota,
                'interes' => $interes,
                'capital' => $capital,
                'saldo_restante' => max($saldoRestante, 0),
                'estado' => $cuota->Estado,
            ];
    
            // Actualizar el estado de la cuota si es necesario
            if ($saldoRestante <= 0) {
                $prestamo->update(['Estado' => 'finalizado']);
            } elseif ($cuota->MontoCuota <= $pagoRealizado) {
                $cuota->update(['Estado' => 'pagado']);
            } else {
                $cuota->update(['Estado' => 'pendiente']);
            }
        }
    
        return view('clientes.amortizacion', [
            'cliente' => $prestamo->cliente,
            'amortizacion' => $amortizacion,
            'prestamo' => $prestamo,
        ]);
    }
}
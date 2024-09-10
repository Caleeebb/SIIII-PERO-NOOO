<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{
    // Descargar PDF del reporte de cliente
    public function descargarPdf($id)
    {
        // Verificar si el cliente existe
        $reporte = DB::table('clientes as c')
            ->join('prestamos as p', 'c.id', '=', 'p.ClienteID')
            ->join('cuotas as cu', 'p.id', '=', 'cu.PrestamoID')
            ->select('c.Nombre', 'c.Apellido', 'p.MontoPrestamo', 'p.FechaEmision', 'cu.MontoCuota', 'cu.estado')
            ->where('c.id', $id)
            ->get();

        if ($reporte->isEmpty()) {
            return redirect()->back()->with('error', 'No se encontraron datos para este cliente.');
        }

        $pdf = Pdf::loadView('reportes.cliente-pdf', compact('reporte'));

        return $pdf->download('reporte_cliente_' . $id . '.pdf');
    }

    // Resumen General de Préstamos
    public function resumen()
    {
        $resumen = DB::table('prestamos')
            ->selectRaw('SUM(MontoPrestamo + (MontoPrestamo * Interes / 100)) AS total_con_interes,
                SUM(MontoPrestamo) AS total_credito,
                 SUM(CASE WHEN Estado = "Cancelado" THEN MontoPrestamo + (MontoPrestamo * Interes / 100) ELSE 0 END) AS total_cancelado')
            ->first();

        return view('reportes.resumen', compact('resumen'));
    }

    // Reporte por Cliente
    public function cliente(Request $request)
    {
        $idCliente = $request->input('id');

        // Validar ID del cliente
        if (!$idCliente || !is_numeric($idCliente)) {
            return view('reportes.cliente')->with('reporte', collect())->with('error', 'ID de cliente inválido.');
        }

        $reporte = DB::table('clientes as c')
            ->join('prestamos as p', 'c.id', '=', 'p.ClienteID')
            ->join('cuotas as cu', 'p.id', '=', 'cu.PrestamoID')
            ->select('c.Nombre', 'c.Apellido', 'p.MontoPrestamo', 'p.FechaEmision', 'cu.MontoCuota', 'cu.estado')
            ->where('c.id', $idCliente)
            ->get();

        if ($reporte->isEmpty()) {
            return view('reportes.cliente')->with('reporte', collect())->with('error', 'No se encontraron datos para este cliente.');
        }

        $cliente = DB::table('clientes')->where('id', $idCliente)->first();

        return view('reportes.cliente', compact('reporte', 'cliente'));
    }

    // Reporte Entre Fechas
    public function entre_fechas(Request $request)
    {
        $fechaInicio = $request->query('fecha_inicio');
        $fechaFin = $request->query('fecha_fin');

        // Validar fechas
        if (!$fechaInicio || !$fechaFin) {
            return view('reportes.entre_fechas')->with('error', 'Fechas inválidas.');
        }

        $reporte = DB::table('clientes as c')
            ->join('prestamos as p', 'c.id', '=', 'p.ClienteID')
            ->join('cuotas as cu', 'p.id', '=', 'cu.PrestamoID')
            ->select('c.Nombre', 'c.Apellido', 'p.MontoPrestamo', 'p.FechaEmision', 'cu.MontoCuota', 'cu.estado')
            ->whereBetween('p.FechaEmision', [$fechaInicio, $fechaFin])
            ->orderBy('p.FechaEmision', 'asc')
            ->get();

        return view('reportes.entre_fechas', [
            'reporte' => $reporte,
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin,
        ]);
    }
}

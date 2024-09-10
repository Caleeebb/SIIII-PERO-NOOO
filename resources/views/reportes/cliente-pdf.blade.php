<!DOCTYPE html>
<html>
<head>
    <title>Reporte del Cliente</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Reporte del Cliente: {{ $reporte->first()->Nombre }} {{ $reporte->first()->Apellido }}</h2>
    <table>
        <thead>
            <tr>
                <th>Monto del Préstamo</th>
                <th>Fecha de Emisión</th>
                <th>Monto de la Cuota</th>
                <th>Estado de la Cuota</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reporte as $detalle)
            <tr>
                <td>{{ $detalle->MontoPrestamo }}</td>
                <td>{{ $detalle->FechaEmision }}</td>
                <td>{{ $detalle->MontoCuota }}</td>
                <td>{{ $detalle->estado }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

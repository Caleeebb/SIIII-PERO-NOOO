<x-layoutsapp>
    <div class="container">
        <h2>Tabla de Amortización para {{ $cliente->Nombre }} {{ $cliente->Apellido }}</h2>

        @if($amortizacion)
        <h3>Tabla de Amortización para el Préstamo de {{ $prestamo->MontoPrestamo }} emitido el {{ $prestamo->FechaEmision }}</h3>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Fecha de Pago</th>
                    <th>Monto de la Cuota</th>
                    <th>Interés</th>
                    <th>Capital</th>
                    <th>Saldo Restante</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($amortizacion as $detalle)
                <tr>
                    <td>{{ $detalle['numero'] }}</td>
                    <td>{{ $detalle['fecha_pago'] }}</td>
                    <td>{{ $detalle['monto_cuota'] }}</td>
                    <td>{{ $detalle['interes'] }}</td>
                    <td>{{ $detalle['capital'] }}</td>
                    <td>{{ $detalle['saldo_restante'] }}</td>
                    <td>{{ $detalle['estado'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @else
        <p>No se encontraron amortizaciones para este préstamo.</p>
        @endif
    </div>
</x-layoutsapp>

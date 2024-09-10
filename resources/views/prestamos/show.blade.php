<x-layoutsapp>
    <div class="container">
        <h2>Detalles del Préstamo</h2>

        <p><strong>Cliente:</strong> {{ $prestamo->cliente->Nombre }}</p>
        <p><strong>Monto Prestado:</strong> {{ $prestamo->MontoPrestamo }}</p>
        <p><strong>Interés:</strong> {{ $prestamo->Interes }}%</p>
        <p><strong>Número de Cuotas:</strong> {{ $prestamo->NumeroCuotas }}</p>
        <p><strong>Forma de Pago:</strong> {{ $prestamo->FormaPago }}</p>
        <p><strong>Fecha de Emisión:</strong> {{ $prestamo->FechaEmision }}</p>
        <p><strong>Estado:</strong> {{ $prestamo->Estado }}</p>

        <h3>Cuotas</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Fecha de Pago</th>
                    <th>Monto</th>
                    <th>Estado</th>
                    <th>Pagos Realizados</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($prestamo->cuotas as $cuota)
                <tr>
                    <td>{{ $cuota->FechaPago }}</td>
                    <td>{{ $cuota->MontoCuota }}</td>
                    <td>{{ $cuota->Estado }}</td>
                    <td>
                        @foreach($cuota->cobros as $cobro)
                            <p>{{ $cobro->FechaCobro }}: {{ $cobro->MontoCobrado }}</p>
                        @endforeach
                    </td>
                    <td>
                        @if($cuota->Estado == 'pendiente')
                        <form action="{{ route('prestamos.pagarCuota', $cuota->id) }}" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="number" step="0.01" name="MontoCobrado" class="form-control" placeholder="Monto a pagar" required>
                                <input type="date" name="FechaCobro" class="form-control" required>
                                <button class="btn btn-success" type="submit">Pagar</button>
                            </div>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('prestamos.index') }}" class="btn btn-secondary">Regresar</a>
    </div>
</x-layoutsapp>

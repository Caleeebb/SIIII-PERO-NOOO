<x-layoutsapp>
    <div class="container">
        <h2>Buscar Reporte del Cliente</h2>
        <form action="{{ route('reporte.cliente') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="number" name="id" class="form-control" placeholder="Ingrese ID del Cliente" required>
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>

        @if($reporte->isNotEmpty())
            <h2>Reporte del Cliente: {{ $reporte->first()->Nombre }} {{ $reporte->first()->Apellido }}</h2>
            <a href="{{ route('cliente.pdf', ['id' => request('id')]) }}" class="btn btn-success mb-4">Descargar PDF</a>
            <table class="table table-bordered">
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
        @else
            <p>No se encontraron datos para este cliente.</p>
        @endif
    </div>
</x-layoutsapp>

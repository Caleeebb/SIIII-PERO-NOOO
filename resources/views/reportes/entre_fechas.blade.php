<x-layoutsapp>
    <div class="container">
        <h2>Generar Reporte Entre Fechas</h2>

        <!-- Mostrar mensajes de error -->
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Formulario para buscar reportes entre fechas -->
        <form action="{{ route('entre_fechas') }}" method="GET">
            <div class="input-group mb-3">
                <input type="date" name="fecha_inicio" class="form-control" required value="{{ request('fecha_inicio') }}">
                <input type="date" name="fecha_fin" class="form-control" required value="{{ request('fecha_fin') }}">
                <button class="btn btn-primary" type="submit">Buscar</button>
            </div>
        </form>

        <!-- Mostrar resultados si existen -->
        @if(isset($reporte) && $reporte->isNotEmpty())
        <h2>Reporte Entre Fechas: {{ $fecha_inicio }} - {{ $fecha_fin }}</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre del Cliente</th>
                    <th>Monto del Préstamo</th>
                    <th>Fecha de Emisión</th>
                    <th>Monto de la Cuota</th>
                    <th>Estado de la Cuota</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reporte as $detalle)
                <tr>
                    <td>{{ $detalle->Nombre }} {{ $detalle->Apellido }}</td>
                    <td>{{ $detalle->MontoPrestamo }}</td>
                    <td>{{ $detalle->FechaEmision }}</td>
                    <td>{{ $detalle->MontoCuota }}</td>
                    <td>{{ $detalle->estado }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @elseif(isset($reporte))
        <p>No se encontraron resultados para el rango de fechas seleccionado.</p>
        @endif
    </div>
</x-layoutsapp>
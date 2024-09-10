<x-layoutsapp>
    <div class="container">
        <h2>Listado de Préstamos</h2>
        <a href="{{ route('prestamos.create') }}" class="btn btn-primary mb-3">Agregar Préstamo</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Monto del Préstamo</th>
                    <th>Interés</th>
                    <th>Número de Cuotas</th>
                    <th>Forma de Pago</th>
                    <th>Fecha de Emisión</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($prestamos as $prestamo)
                <tr>
                    <td>{{ $prestamo->id }}</td>
                    <td>{{ $prestamo->cliente->Nombre }}</td>
                    <td>{{ $prestamo->MontoPrestamo }}</td>
                    <td>{{ $prestamo->Interes }}%</td>
                    <td>{{ $prestamo->NumeroCuotas }}</td>
                    <td>{{ $prestamo->FormaPago }}</td>
                    <td>{{ $prestamo->FechaEmision }}</td>
                    <td>{{ $prestamo->Estado }}</td>
                    <td>
                        <a href="{{ route('prestamos.show', $prestamo->id) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('prestamos.edit', $prestamo->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('prestamos.destroy', $prestamo->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layoutsapp>

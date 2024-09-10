<x-layoutsapp>
    <div class="container">
        <h2>Listado de Cuotas</h2>
        <a href="{{ route('cuotas.create') }}" class="btn btn-primary mb-3">Agregar Cuota</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Préstamo ID</th>
                    <th>Fecha de Pago</th>
                    <th>Monto de la Cuota</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cuotas as $cuota)
                <tr>
                    <td>{{ $cuota->id }}</td>
                    <td>{{ $cuota->prestamo->id }}</td>
                    <td>{{ $cuota->FechaPago }}</td>
                    <td>{{ $cuota->MontoCuota }}</td>
                    <td>{{ $cuota->Estado }}</td>
                    <td>
                        <a href="{{ route('cuotas.edit', $cuota->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('cuotas.destroy', $cuota->id) }}" method="POST" style="display:inline-block;">
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

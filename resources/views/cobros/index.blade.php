<x-layoutsapp>
<div class="container">
    <h2>Listado de Cobros</h2>
    <a href="{{ route('cobros.create') }}" class="btn btn-primary">Registrar Nuevo Cobro</a>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cuota</th>
                <th>Fecha de Cobro</th>
                <th>Monto Cobrado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cobros as $cobro)
            <tr>
                <td>{{ $cobro->id }}</td>
                <td>{{ $cobro->cuota->id }} - {{ $cobro->cuota->Descripcion }}</td>
                <td>{{ $cobro->FechaCobro }}</td>
                <td>{{ $cobro->MontoCobrado }}</td>
                <td>
                    <a href="{{ route('cobros.edit', $cobro->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('cobros.destroy', $cobro->id) }}" method="POST" style="display:inline;">
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

<x-layoutsapp>
    <div class="container">
        <h2>Lista de Clientes</h2>
        <a href="{{ route('clientes.create') }}" class="btn btn-primary mb-3">Agregar Cliente</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>CorreoElectronico</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->DNI }}</td>
                        <td>{{ $cliente->Nombre }}</td>
                        <td>{{ $cliente->CorreoElectronico }}</td>
                        <td>
                            <a href="{{ route('clientes.amortizacion', $cliente->id) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display:inline-block;">
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
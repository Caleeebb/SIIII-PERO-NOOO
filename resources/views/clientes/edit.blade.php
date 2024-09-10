<x-layoutsapp>
    <div class="container">
        <h2>Editar Cliente</h2>
        <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="Nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="Nombre" name="Nombre" value="{{ $cliente->Nombre }}" required>
            </div>
            <div class="mb-3">
                <label for="CorreoElectronico" class="form-label">Email</label>
                <input type="email" class="form-control" id="CorreoElectronico" name="CorreoElectronico" value="{{ $cliente->CorreoElectronico }}" required>
            </div>
            <!-- Otros campos como dirección, teléfono, etc. -->
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
    </x-layoutsapp>

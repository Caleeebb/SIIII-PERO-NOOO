<x-layoutsapp>
    <div class="container">
        <h2>Agregar Cliente</h2>
        <form action="{{ route('clientes.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="DNI" class="form-label">DNI</label>
                <input type="text" class="form-control" id="DNI" name="DNI" required>
            </div>
            <div class="mb-3">
                <label for="Nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="Nombre" name="Nombre" required>
            </div>
            <div class="mb-3">
                <label for="Apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="Apellido" name="Apellido" required>
            </div>
            
            <div class="mb-3">
                <label for="FechaNacimiento" class="form-label">Fecha de Nacimiento</label>
                <input type="date" class="form-control" id="FechaNacimiento" name="FechaNacimiento" required>
            </div>
            <div class="mb-3">
                <label for="Direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" id="Direccion" name="Direccion">
            </div>
            <div class="mb-3">
                <label for="Telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="Telefono" name="Telefono">
            </div>
            <div class="mb-3">
                <label for="CorreoElectronico" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="CorreoElectronico" name="CorreoElectronico" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</x-layoutsapp>
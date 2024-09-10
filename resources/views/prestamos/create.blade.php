<x-layoutsapp>
    <div class="container">
        <h2>Crear Nuevo Préstamo</h2>
        <form action="{{ route('prestamos.store') }}" method="POST">
            @csrf
            @include('components.validations')
            <div class="mb-3">
                <label for="ClienteID" class="form-label">Cliente</label>
                <select name="ClienteID" class="form-control" required>
                    <option value="">Seleccione un cliente</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->Nombre }} {{ $cliente->Apellido }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="MontoPrestamo" class="form-label">Monto del Préstamo</label>
                <input type="number" name="MontoPrestamo" class="form-control" step="0.01" required>
            </div>

            <div class="mb-3">
                <label for="Interes" class="form-label">Interés (%)</label>
                <input type="number" name="Interes" class="form-control" step="0.01" required>
            </div>

            <div class="mb-3">
                <label for="NumeroCuotas" class="form-label">Número de Cuotas</label>
                <input type="number" name="NumeroCuotas" class="form-control" min="1" required>
            </div>

            <div class="mb-3">
                <label for="FormaPago" class="form-label">Forma de Pago</label>
                <input type="text" name="FormaPago" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="FechaEmision" class="form-label">Fecha de Emisión</label>
                <input type="date" name="FechaEmision" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="Estado" class="form-label">Estado</label>
                <input type="text" name="Estado" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Préstamo</button>
        </form>
    </div>
</x-layoutsapp>

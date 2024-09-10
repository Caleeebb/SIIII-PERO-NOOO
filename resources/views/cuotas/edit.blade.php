<x-layoutsapp>
    <div class="container">
        <h2>Editar Cuota</h2>

        <form action="{{ route('cuotas.update', $cuota->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="PrestamoID">Préstamo</label>
                <select name="PrestamoID" id="PrestamoID" class="form-control">
                    @foreach($prestamos as $prestamo)
                    <option value="{{ $prestamo->id }}" {{ $cuota->PrestamoID == $prestamo->id ? 'selected' : '' }}>{{ $prestamo->id }} - {{ $prestamo->MontoPrestamo }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="FechaPago">Fecha de Pago</label>
                <input type="date" name="FechaPago" id="FechaPago" class="form-control" value="{{ $cuota->FechaPago }}" required>
            </div>

            <div class="form-group">
                <label for="MontoCuota">Monto de la Cuota</label>
                <input type="number" name="MontoCuota" id="MontoCuota" class="form-control" value="{{ $cuota->MontoCuota }}" required>
            </div>

            <div class="form-group">
                <label for="Estado">Estado</label>
                <select name="Estado" id="Estado" class="form-control">
                    <option value="pendiente" {{ $cuota->Estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="pagado" {{ $cuota->Estado == 'pagado' ? 'selected' : '' }}>Pagado</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</x-layoutsapp>

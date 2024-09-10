<x-layoutsapp>
    <div class="container">
        <h2>Agregar Cuota</h2>

        <form action="{{ route('cuotas.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="PrestamoID">Préstamo</label>
                <select name="PrestamoID" id="PrestamoID" class="form-control">
                    @foreach($prestamos as $prestamo)
                    <option value="{{ $prestamo->id }}">{{ $prestamo->id }} - {{ $prestamo->MontoPrestamo }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="FechaPago">Fecha de Pago</label>
                <input type="date" name="FechaPago" id="FechaPago" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="MontoCuota">Monto de la Cuota</label>
                <input type="number" name="MontoCuota" id="MontoCuota" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="Estado">Estado</label>
                <select name="Estado" id="Estado" class="form-control">
                    <option value="pendiente">Pendiente</option>
                    <option value="pagado">Cancelado</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</x-layoutsapp>

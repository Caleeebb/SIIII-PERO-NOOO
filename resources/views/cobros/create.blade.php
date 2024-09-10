<x-layoutsapp>
    <div class="container">
        <h2>Registrar Nuevo Cobro</h2>

        <form action="{{ route('cobros.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="CuotaID">Cuota:</label>
                <select name="CuotaID" id="CuotaID" class="form-control" required>
                    @foreach($cuotas as $cuota)
                        <option value="{{ $cuota->id }}">
                            Cuota #{{ $cuota->id }} - Monto: {{ number_format($cuota->MontoCuota, 2) }} - Estado: {{ $cuota->Estado }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="FechaCobro">Fecha de Cobro:</label>
                <input type="date" name="FechaCobro" id="FechaCobro" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="MontoCobrado">Monto Cobrado:</label>
                <input type="number" name="MontoCobrado" id="MontoCobrado" class="form-control" step="0.01" min="0" required>
            </div>

            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
</x-layoutsapp>

<x-layoutsapp>
<div class="container">
    <h2>Editar Cobro</h2>

    <form action="{{ route('cobros.update', $cobro->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="CuotaID">Cuota:</label>
            <select name="CuotaID" id="CuotaID" class="form-control" required>
                @foreach($cuotas as $cuota)
                    <option value="{{ $cuota->id }}" {{ $cuota->id == $cobro->CuotaID ? 'selected' : '' }}>
                        {{ $cuota->id }} - {{ $cuota->Descripcion }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="FechaCobro">Fecha de Cobro:</label>
            <input type="date" name="FechaCobro" id="FechaCobro" class="form-control" value="{{ $cobro->FechaCobro }}" required>
        </div>
        <div class="form-group">
            <label for="MontoCobrado">Monto Cobrado:</label>
            <input type="number" name="MontoCobrado" id="MontoCobrado" class="form-control" value="{{ $cobro->MontoCobrado }}" step="0.01" min="0" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
</x-layoutsapp>

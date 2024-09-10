<x-layoutsapp>
    <div class="container">
        <h2>Detalles del Cliente</h2>
        <div>
            <strong>Nombre:</strong> {{ $cliente->Nombre }}
        </div><br>
        <div>
            <strong>Apellido:</strong> {{ $cliente->Apellido }}
        </div><br>
        <div>
            <strong>Genero:</strong> {{ $cliente->Genero }}
        </div><br>
        <div>
            <strong>Fecha de Nacimiento:</strong> {{ $cliente->FechaNacimiento }}
        </div><br>
        <div>
            <strong>Direccion:</strong> {{ $cliente->Direccion }}
        </div><br>
        <div>
            <strong>Telefono:</strong> {{ $cliente->Telefono }}
        </div><br>
        <div>
            <strong>Email:</strong> {{ $cliente->CorreoElectronico }}
        </div><br>

        <!-- Sección de Préstamos -->
        <h3>Préstamos del Cliente</h3>
        @if($prestamos->isEmpty())
            <p>Este cliente no tiene préstamos registrados.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Monto del Préstamo</th>
                        <th>Interés</th>
                        <th>Número de Cuotas</th>
                        <th>Forma de Pago</th>
                        <th>Fecha de Emisión</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prestamos as $prestamo)
                        <tr>
                            <td>{{ $prestamo->id }}</td>
                            <td>{{ $prestamo->MontoPrestamo }}</td>
                            <td>{{ $prestamo->Interes }}%</td>
                            <td>{{ $prestamo->NumeroCuotas }}</td>
                            <td>{{ $prestamo->FormaPago }}</td>
                            <td>{{ $prestamo->FechaEmision }}</td>
                            <td>{{ $prestamo->Estado }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <a href="{{ route('clientes.index') }}" class="btn btn-primary mt-3">Volver a la Lista</a>
    </div>
</x-layoutsapp>

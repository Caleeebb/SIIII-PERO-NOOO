<!-- resources/views/reportes/resumen.blade.php -->
<x-layoutsapp>
    <div class="container">
        <h2>Resumen General de Préstamos</h2><br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Total Crédito</th>
                    <th>Total con Interés</th>
                    <th>Total Cancelado</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $resumen->total_credito }}</td>
                    <td>{{ $resumen->total_con_interes }}</td>
                    <td>{{ $resumen->total_cancelado }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</x-layoutsapp>
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ClienteID')->constrained('clientes')->onDelete('cascade'); // Clave foránea
            $table->decimal('MontoPrestamo', 10, 2);
            $table->decimal('Interes', 5, 2);
            $table->integer('NumeroCuotas');
            $table->enum('FormaPago', ['Diario', 'Semanal', 'Quincenal', 'Mensual']);
            $table->date('FechaEmision');
            $table->enum('Estado', ['Pendiente', 'Cancelado'])->default('Pendiente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestamos');
    }
};

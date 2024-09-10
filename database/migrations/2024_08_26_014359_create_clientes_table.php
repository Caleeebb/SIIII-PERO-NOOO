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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('DNI')->unique();
            $table->string('Nombre');
            $table->string('Apellido');
            $table->enum('Genero', ['Masculino', 'Femenino']);
            $table->date('FechaNacimiento');
            $table->string('Direccion');
            $table->string('Telefono');
            $table->string('CorreoElectronico')->unique();
            $table->timestamps();// created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};

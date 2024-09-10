<?php

// database/migrations/xxxx_xx_xx_create_cobros_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCobrosTable extends Migration
{
    public function up()
    {
        Schema::create('cobros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('CuotaID');
            $table->date('FechaCobro');
            $table->decimal('MontoCobrado', 8, 2);
            $table->timestamps();

            // Relación con la tabla cuotas
            $table->foreign('CuotaID')->references('id')->on('cuotas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cobros');
    }
}

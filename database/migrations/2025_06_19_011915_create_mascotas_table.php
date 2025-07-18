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
        Schema::create('mascotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('especie_id')->references('id')->on('especies');
            $table->foreignId('raza_id')->references('id')->on('razas');
            $table->foreignId('cliente_id')->references('id')->on('clientes');
            $table->string('nombre');
            $table->date('fecha_nacimiento');
            $table->integer('edad');
            $table->boolean('sexo');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mascotas');
    }
};

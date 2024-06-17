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
        Schema::create('clases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_categoria')->constrained('categorias', 'id');
            $table->string('instructor');
            $table->integer('cupos_totales');
            $table->integer('cupos_disponibles');
            $table->string('duracion');
            $table->date('fecha_inicio');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->integer('costo_inscripcion');
            $table->string('estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clases');
    }
};

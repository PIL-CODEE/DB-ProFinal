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
        Schema::create('inscripcion_torneos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_torneo')->constrained('torneos', 'id');
            $table->foreignId('id_usuario')->constrained('users', 'id');
            $table->integer('puntaje');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscripcion_torneos');
    }
};

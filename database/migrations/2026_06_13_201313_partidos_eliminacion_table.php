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
        Schema::create('partidos_eliminacion', function(Blueprint $table){
        $table->id();
        $table->string('ronda', 50);
        $table->foreignId('equipo1_id')->constrained('equipos');
        $table->foreignId('equipo2_id')->constrained('equipos');
        $table->foreignId('ganador_id')->nullable()->constrained('equipos');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partidos_eliminacion');
    }
};

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
        Schema::create('partidos_grupo', function(Blueprint $table){
        $table->id();
        $table->foreignId('grupo_id')->constrained();
        $table->foreignId('equipo1_id')->constrained('equipos');
        $table->foreignId('equipo2_id')->constrained('equipos');
        $table->integer('goles1')->nullable();
        $table->integer('goles2')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partidos_grupo');
    }
};

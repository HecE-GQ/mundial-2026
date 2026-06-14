<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    // Un equipo pertenece a un grupo
    public function grupo(){
        return $this->belongsTo(Grupo::class);
    }

    // Un equipo TIENE MUCHOS partidos como Equipo1 y Equipo2
    public function partidosComoEquipo1(){
        return $this->hasMany(PartidoGrupo::class, 'equipo1_id');
    }

    public function partidoComoEquipo2(){
        return $this->hasMany(PartidoGrupo::class, 'equipo2_id');
    }
}

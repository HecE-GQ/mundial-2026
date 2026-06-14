<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartidoGrupo extends Model
{
    public function grupo(){
        return $this->belongsTo(Grupo::class);
    }

    public function equipo1(){
        return $this->belongsTo(Equipo::class, 'equipo1_id');
    }

    public function equipo2(){
        return $this->belongsTo(Equipo::class, 'equipo2_id');
    }
}

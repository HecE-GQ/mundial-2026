<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $fillable = ['nombre'];

    public function equipos(){
        return $this->hasMany(Equipo::class);
    }

    public function partidosGrupo(){
        return $this->hasMany(PartidoGrupo::class, 'grupo_id');
    }
}

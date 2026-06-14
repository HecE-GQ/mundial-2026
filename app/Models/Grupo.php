<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    public function equipos(){
        return $this->hasMany(Equipo::class);
    }
}

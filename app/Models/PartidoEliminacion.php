<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartidoEliminacion extends Model
{
    public function equipo1()
    {
        return $this->belongsTo(Equipo::class, 'equipo1_id');
    }
    
    public function equipo2()
    {
        return $this->belongsTo(Equipo::class, 'equipo2_id');
    }
    
    public function ganador()
    {
        return $this->belongsTo(Equipo::class, 'ganador_id');
    }
}

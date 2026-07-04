<?php

namespace App\Services;
use App\Models\Grupo;

class ClasificacionService 
{
    /**
     * Recalcula la clasificacion de un grupo
     * Retorna Array con equipos ordenados 
     */

    public function recalcularGrupo($grupoId){
        $grupo = Grupo::find($grupoId);

        // Array temp con los datos de cada equipo

        $tabla =[];

        foreach($grupo->equipos as $equipo){
            $tabla[$equipo->id]=[
                'equipo_id' => $equipo->id,
                'nombre' => $equipo->nombre,
                'pj' => 0,      // Partidos jugados
                'pg' => 0,      // Partidos ganados
                'pe' => 0,      // Partidos empatados
                'pp' => 0,      // Partidos perdidos
                'gf' => 0,      // Goles a favor
                'gc' => 0,      // Goles en contra
                'pts' => 0,     // Puntos
            ];
        }
        // Obtener ls partidos 
        $partidos = $grupo->partidosGrupo()->get();

        foreach($partidos as $partido){
            if($partido->goles1 === null || $partido->goles2 === null){
                continue;
            }
            $equipo1_id = $partido->equipo1_id;
            $equipo2_id = $partido->equipo2_id;
            $goles1 = $partido->goles1;
            $goles2 = $partido->goles2;

            // Actualizar Estadisticas Equipo1
            $tabla[$equipo1_id]['pj']++;
            $tabla[$equipo1_id]['gf'] += $goles1;
            $tabla[$equipo1_id]['gc'] += $goles2;
            // Actualizar Estadisticas Equipo2
            $tabla[$equipo2_id]['pj']++;
            $tabla[$equipo2_id]['gf'] += $goles2;
            $tabla[$equipo2_id]['gc'] += $goles1;

            // Calculo de puntos 
            if($goles1 > $goles2){
                // Equipo1 Gana 
                $tabla[$equipo1_id]['pg']++;
                $tabla[$equipo1_id]['pts'] += 3;

                // Equipo 2 pierde
                $tabla[$equipo2_id]['pp']++;
            }else if($goles1 < $goles2){
                // Equipo 2 Gana 
                $tabla[$equipo2_id]['pg']++;
                $tabla[$equipo2_id]['pts'] += 3;

                $tabla[$equipo1_id]['pp']++;
            }else{
                // Empate 
                $tabla[$equipo1_id]['pe']++;
                $tabla[$equipo1_id]['pts'] += 1;

                $tabla[$equipo2_id]['pe']++;
                $tabla[$equipo2_id]['pts']+=1;
            }
        }
        // Calcular dif de goles 
        foreach($tabla as &$equipo){
            $equipo['dif'] = $equipo['gf'] - $equipo['gc'];
        }

        // Ordenamos por puntos DESC 
        usort($tabla, function($a, $b){
            if($a['pts'] !== $b['pts']){
                return $b['pts'] - $a['pts'];
            }
            if($a['dif']!== $b['dif']){
                return $b['dif'] - $a['dif'];
            }
            return $b['gf'] - $a['gf'];
        });
        return $tabla;
    }
}
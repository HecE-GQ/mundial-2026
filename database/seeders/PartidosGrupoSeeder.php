<?php

namespace Database\Seeders;
use App\Models\Grupo;
use App\Models\PartidoGrupo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartidosGrupoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grupos = Grupo::all();

        foreach($grupos as $grupo){
            $equipos = $grupo->equipos()->get();

            // Generado enfrentamientos
            for($i = 0; $i < count($equipos); $i++){
                for($j = $i + 1; $j < count($equipos); $j++){
                    PartidoGrupo::create([
                        'grupo_id' => $grupo->id,
                        'equipo1_id' => $equipos[$i]->id,
                        'equipo2_id' => $equipos[$j]->id,
                        'goles1' => null,
                        'goles2' => null
                    ]);
                }
            }
        }
    }
}

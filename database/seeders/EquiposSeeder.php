<?php

namespace Database\Seeders;

use App\Models\Grupo;
use App\Models\Equipo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EquiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grupos = [];
        foreach(range('A', 'L') as $letra){
            $grupos[$letra] = Grupo::create(['nombre'=>$letra]);
        }

        // Equipor por grupo
        $equiposPorGrupo = [
            "A" => [
                ['nombre' => 'México', 'bandera'=>'MEX'],
                ['nombre' => 'Sudáfrica', 'bandera'=>'RSA'],
                ['nombre' => 'Corea del Sur', 'bandera'=>'KOR'],
                ['nombre' => 'Republica Checa', 'bandera'=>'CZE']
            ],
            'B' =>[
                ['nombre' => 'Canadá', 'bandera' => 'CAN'],
                ['nombre' => 'Bosnia y Herzegovina', 'bandera' => 'BIH'],
                ['nombre' => 'Qatar', 'bandera' => 'QAT'],
                ['nombre' => 'Suiza', 'bandera' => 'SUI']
            ],
            'C'=>[
                ['nombre'=>'Brasil', 'bandera'=>'BRA'],
                ['nombre'=>'Marruecos', 'bandera'=>'MAR'],
                ['nombre'=>'Haití', 'bandera'=>'SCO'],
                ['nombre'=>'Escocia', 'bandera'=>'HAI']
            ],
            'D'=>[
                ['nombre'=>'Estados Unidos', 'bandera'=>'USA'],
                ['nombre'=>'Paraguay', 'bandera'=>'PAR'],
                ['nombre'=>'Australia', 'bandera'=>'AUS'],
                ['nombre'=>'Turquía', 'bandera'=>'TUR']
            ],
            'E'=>[
                ['nombre'=>'Alemania', 'bandera'=>'GER'],
                ['nombre'=>'Curazao', 'bandera'=>'CUW'],
                ['nombre'=>'Costa de Marfil', 'bandera'=>'CIV'],
                ['nombre'=>'Ecuador', 'bandera'=>'ECU']
            ],
            'F'=>[
                ['nombre'=>'Países Bajos', 'bandera'=>'NED'],
                ['nombre'=>'Japón', 'bandera'=>'JPN'],
                ['nombre'=>'Suecia', 'bandera'=>'SWE'],
                ['nombre'=>'Túnez', 'bandera'=>'TUN']
            ],
            'G'=>[
                ['nombre'=>'Bélgica', 'bandera'=>'BEL'],
                ['nombre'=>'Egipto', 'bandera'=>'EGY'],
                ['nombre'=>'RI de Irán', 'bandera'=>'IRN'],
                ['nombre'=>'Nueva Zelanda', 'bandera'=>'NZL']
            ],
            'H'=>[
                ['nombre'=>'España', 'bandera'=>'ESP'],
                ['nombre'=>'Islas de Cabo Verde', 'bandera'=>'CPV'],
                ['nombre'=>'Arabia Saudí', 'bandera'=>'KSA'],
                ['nombre'=>'Uruguay', 'bandera'=>'URU']
            ],
            'I'=>[
                ['nombre'=>'Francia', 'bandera'=>'FRA'],
                ['nombre'=>'Senegal', 'bandera'=>'SEN'],
                ['nombre'=>'Irak', 'bandera'=>'IRQ'],
                ['nombre'=>'Noruega', 'bandera'=>'NOR']
            ],
            'J'=>[
                ['nombre'=>'Argentina', 'bandera'=>'ARG'],
                ['nombre'=>'Argelia', 'bandera'=>'ALG'],
                ['nombre'=>'Austria', 'bandera'=>'AUT'],
                ['nombre'=>'Jordania', 'bandera'=>'JOR']
            ],
            'K'=>[
                ['nombre'=>'Portugal', 'bandera'=>'POR'],
                ['nombre'=>'RD Congo', 'bandera'=>'COD'],
                ['nombre'=>'Uzbekistán', 'bandera'=>'UZB'],
                ['nombre'=>'Colombia', 'bandera'=>'COL']
            ],
            'L'=>[
                ['nombre'=>'Inglaterra', 'bandera'=>'ENG'],
                ['nombre'=>'Croacia', 'bandera'=>'CRO'],
                ['nombre'=>'Ghana', 'bandera'=>'GHA'],
                ['nombre'=>'Panamá', 'bandera'=>'PAN']
            ],
        ];

        // Equipos 
        foreach($equiposPorGrupo as $letraGrupo => $equipos){
            foreach($equipos as $equipo){
                Equipo::create([
                    'grupo_id' => $grupos[$letraGrupo]->id,
                    'nombre'=>$equipo['nombre'],
                    'bandera'=>$equipo['bandera'],
                ]);
            }
        }
    }
}

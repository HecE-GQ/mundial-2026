<?php

namespace Database\Seeders;

use App\Models\Grupo;
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
                ['nombre' => 'México', 'bandera'=>'MX'],
                ['nombre' => 'Sudafrica', 'bandera'=>'RSA'],
                ['nombre' => 'Corea del Sur', 'bandera'=>'KOR'],
                ['nombre' => 'Republica Checa', 'bandera'=>'CZ']
            ],
            'B' =>[
                ['nombre' => 'Canadá', 'bandera' => 'CA'],
                ['nombre' => 'Bosnia y Herzegovina', 'bandera' => 'BiH'],
                ['nombre' => 'Qatar', 'bandera' => 'QA'],
                ['nombre' => 'Suiza', 'bandera' => 'CH']
            ],
            'C'=>[
                ['nombre'=>'Brasil', 'bandera'=>'BRA'],
                ['nombre'=>'Marruecos', 'bandera'=>'MAR'],
                ['nombre'=>'Haití', 'bandera'=>'SCO'],
                ['nombre'=>'Escocia', 'bandera'=>'HAI']
            ],
            'D'=>[
                ['nombre'=>'Estados Unidos', 'bandera'=>'USA'],
                ['nombre'=>'Paraguay', 'bandera'=>'PRY'],
                ['nombre'=>'Australia', 'bandera'=>'AUS'],
                ['nombre'=>'Turquía', 'bandera'=>'TUR']
            ]
        ];
    }
}

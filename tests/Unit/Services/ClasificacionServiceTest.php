<?php

namespace Tests\Unit\Services;

// 1. CAMBIADO: Usamos el TestCase de Laravel en lugar del de PHPUnit puro
use Tests\TestCase; 
// 2. AÑADIDO: Trait para que Laravel maneje la BD temporal automáticamente
use Illuminate\Foundation\Testing\RefreshDatabase; 

use App\Services\ClasificacionService;
use App\Models\Grupo;
use App\Models\Equipo;
use App\Models\PartidoGrupo;

class ClasificacionServiceTest extends TestCase
{
    // 3. AÑADIDO: Indicamos a Laravel que limpie la BD en cada ejecución
    use RefreshDatabase; 

    private $service;
    private $grupo;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new ClasificacionService();
    }
    
    public function test_victoria_otorga_3_puntos()
    {
        // Arrange: Crear grupo + 2 equipos
        $grupo = Grupo::create(['nombre' => 'TEST']);
        $equipo1 = Equipo::create([
            'grupo_id' => $grupo->id,
            'nombre' => 'Equipo A',
            'bandera' => '🇦🇷'
        ]);
        $equipo2 = Equipo::create([
            'grupo_id' => $grupo->id,
            'nombre' => 'Equipo B',
            'bandera' => '🇧🇷'
        ]);
        
        // Crear partido: A gana 2-0
        PartidoGrupo::create([
            'grupo_id' => $grupo->id,
            'equipo1_id' => $equipo1->id,
            'equipo2_id' => $equipo2->id,
            'goles1' => 2,
            'goles2' => 0,
        ]);
        
        // Act
        $tabla = $this->service->recalcularGrupo($grupo->id);
        
        // Assert
        $equipoAEnTabla = collect($tabla)->firstWhere('equipo_id', $equipo1->id);
        $this->assertEquals(3, $equipoAEnTabla['pts']);
        $this->assertEquals(2, $equipoAEnTabla['gf']);
        $this->assertEquals(0, $equipoAEnTabla['gc']);
    }
    
    public function testEmpate(){
        $grupo = Grupo::create(['nombre'=>'TEST']);
        $equipo1 = Equipo::create([
            'grupo_id' => $grupo->id,
            'nombre' => 'EquipoC',
            'bandera' => 'C'
        ]);
        $equipo2 = Equipo::create([
            'grupo_id' => $grupo->id,
            'nombre' => 'EquipoD',
            'bandera' => 'D'
        ]);

        // Partidos 
        $partido = PartidoGrupo::create([
            'grupo_id'=>$grupo->id,
            'equipo1_id' => $equipo1->id,
            'equipo2_id' => $equipo2->id,
            'goles1' => 1,
            'goles2' => 1
        ]);

        $tabla = $this->service->recalcularGrupo($grupo->id);
        
        //Assert
        $equipoEnTabla = collect($tabla)->firstWhere('equipo_id', $equipo1->id);
        $this->assertEquals(1, $equipoEnTabla['pts']);
        $this->assertEquals(1, $equipoEnTabla['gf']);
        $this->assertEquals(1, $equipoEnTabla['gc']);
        
        $equipoEnTabla = collect($tabla)->firstWhere('equipo_id', $equipo2->id);
        $this->assertEquals(1, $equipoEnTabla['pts']);
        $this->assertEquals(1, $equipoEnTabla['gf']);
        $this->assertEquals(1, $equipoEnTabla['gc']);
    }

     public function testDerrota0Pts(){
        $grupo = Grupo::create(['nombre'=>'TEST_FAIL']);

        $equipo1 = Equipo::create([
            'grupo_id' => $grupo->id,
            'nombre' => 'TestFail1',
            'bandera' => 'TF'
        ]);
        $equipo2 = Equipo::create([
            'grupo_id' => $grupo->id,
            'nombre' => 'TestFail2',
            'bandera' => 'TF2'
        ]);

        PartidoGrupo::create([
            'grupo_id' => $grupo->id,
            'equipo1_id' => $equipo1->id,
            'equipo2_id' =>  $equipo2->id,
            'goles1' => 1,
            'goles2' => 3
        ]);
            // Instanciar service 
            $service = new ClasificacionService();
            $tabla = $service->recalcularGrupo($grupo->id);

            // Error a proposito
            $equipoEnTabla = collect($tabla)->firstWhere('equipo_id', $equipo1->id);
            $this->assertEquals(0, $equipoEnTabla['pts']);

    }
}
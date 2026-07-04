<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PartidoGrupo;
use App\Services\ClasificacionService;

class GrupoController extends Controller
{
    // Metodo para actualizar resultado
    protected $clasificacionService;

    // Instanciar servie en el constructor 
    public function __construct(ClasificacionService $clasificacionService)
    {
            $this->clasificacionService = $clasificacionService;
    }

    /**
     * Actualiza goles de un partido y retornar tabla actualizada
     * POST /api/partidos/{id}/actualizar
     * Body: {"goles1":1, "goles2":2}
     */

    public function actualizarPartido(Request $request, $partidoId){
        
        $validate = $request->validate([
            'goles1' => 'required|integer|min:0|max:20',
            'goles2' => 'required|integer|min:0|max:20'
        ]);

        // Obtener partido 
        $partido = PartidoGrupo::findOrFail($partidoId);

        // Actualizar bd 
        $partido->update([
            'goles1'=>$validate['goles1'],
            'goles2'=>$validate['goles2'],
        ]);

        // Recalcular tabla 
        $tabla = $this->clasificacionService->recalcularGrupo($partido->grupo_id);

        // retornamos JSON 
        return response()->json([
            'success' => true,
            'mensaje' => 'Resultado Actualizado',
            'partido' => $partido,
            'tabla' => $tabla,
        ]);
    }

}

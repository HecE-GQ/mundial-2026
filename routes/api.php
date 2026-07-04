<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GrupoController;


Route::middleware('api')->group(function (){
    // Post
    Route::post('/partidos/{id}/actualizar', [GrupoController::class, 'actualizarPartido']);
});
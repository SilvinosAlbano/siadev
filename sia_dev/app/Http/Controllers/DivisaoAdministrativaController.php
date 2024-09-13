<?php
// app/Http/Controllers/DivisaoAdministrativaController.php
namespace App\Http\Controllers;

use App\Models\ViewMunicipioPosto;
use App\Models\ViewPostoSuco;
use App\Models\ViewSucoAldeia;
use Illuminate\Http\Request;

class DivisaoAdministrativaController extends Controller
{
    // Fetch Postos based on selected Municipio
    public function getPostos($idMunicipio)
    {
        $postos = ViewMunicipioPosto::where('id_municipio', $idMunicipio)->get();
        return response()->json($postos);
    }

    // Fetch Sucos based on selected Posto
    public function getSucos($idPosto)
    {
        $sucos = ViewPostoSuco::where('id_posto_administrativo', $idPosto)->get();
        return response()->json($sucos);
    }

    // Fetch Aldeias based on selected Suco
    public function getAldeias($idSuco)
    {
        $aldeias = ViewSucoAldeia::where('id_sucos', $idSuco)->get();
        return response()->json($aldeias);
    }
}

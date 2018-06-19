<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MstroUndsMedida as UnidadesMedida;


class MstroUndsMedidaController extends Controller
{
    private $Page_Title;


    public function __construct(){

    }

    public function index() {
        $UnidadesMedida =  UnidadesMedida::orderBy('nom_med')->where('id_med','>','0')->paginate(10);
        return $UnidadesMedida;
    }


    public function store(Request $FormData) {
        $this->validate( $FormData , ['nom_med'=>'required']);
        $UnidadMed           = new UnidadesMedida;
        $UnidadMed->nom_med  = $FormData->nom_med;
        $UnidadMed->inactivo = 0;
        $UnidadMed->save();
    }


    public function update(Request $FormData)   {
        $this->validate( $FormData , ['nom_med'=>'required']);
        $UnidadMed           = UnidadesMedida::findOrFail($FormData->id_med );
        $UnidadMed->nom_med  = $FormData->nom_med;
        $UnidadMed->inactivo = $FormData->inactivo;
        $UnidadMed->update();
    }

    public function destroy($id) {
        $UnidadMed = UnidadesMedida::findOrFail($id );
        $UnidadMed->delete();
    }
}

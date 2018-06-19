<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MstroLineasSubLinea as SubLineas;


class MstroLineasSubLineasController extends Controller
{
    public function index()  {
        $SubLineas =  SubLineas::orderBy('nom_sub_linea')->where('id_sub_linea','>','0')->paginate(10);
        return $SubLineas ;
    }

    public function ConsultaSubLineas()  {
        $SubLineas =  SubLineas::orderBy('nom_sub_linea')->where('id_sub_linea','>','0')->get();
        return $SubLineas ;
    }

    public function store(Request $FormData) {
        $this->validate( $FormData , ['nom_sub_linea'=>'required']);
        $SubLineas           = new SubLineas;
        $SubLineas->nom_sub_linea  = $FormData->nom_sub_linea;
        $SubLineas->inactivo = 0;
        $SubLineas->save();
    }


    public function update(Request $FormData)   {
        $this->validate( $FormData , ['nom_sub_linea'=>'required']);
        $SubLinea           = SubLineas::findOrFail($FormData->id_sub_linea );
        $SubLinea->nom_sub_linea  = $FormData->nom_sub_linea;
        $SubLinea->inactivo = $FormData->inactivo;
        $SubLinea->update();
    }

    public function destroy($id) {
        $SubLinea = SubLineas::findOrFail($id );
        $SubLinea->delete();
    }
}

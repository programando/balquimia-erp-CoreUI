<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MstroLinea as Lineas;

class MstroLineasController extends Controller
{
     private $Page_Title;


    public function __construct(){
        $this->Page_Title = 'Líneas de Producto';
    }

    public function prueba(){
      //<td>{{ $user->getRoleNames()->implode(', ') }}</td>
         $Lineas =  Lineas::withCount('SubLineas')
                    ->with('SubLineas')
                    ->orderBy('nom_linea')->where('id_linea','>','0')->paginate(10);
         return $Lineas;
    }


    public function index() {

        $Lineas =  Lineas::withCount('SubLineas')
                      ->with('SubLineas')
                      ->orderBy('nom_linea')
                      ->where('id_linea','>','0')
                      ->paginate(10);

         return [
            'pagination' => [
                'total'        => $Lineas->total(),
                'current_page' => $Lineas->currentPage(),
                'per_page'     => $Lineas->perPage(),
                'last_page'    => $Lineas->lastPage(),
                'from'         => $Lineas->firstItem(),
                'to'           => $Lineas->lastItem(),
            ],
            'Registros' => $Lineas
        ];

    }


    public function showForm(){

        //return Lineas::with('SubLineas')->get();

        $Page_Title = $this->Page_Title;
        return view('maestros.lineas', compact('Page_Title'));
    }


    public function store(Request $FormData) {
        $this->validate( $FormData , ['nom_linea'=>'required', 'cod_linea' =>'required|unique:gral_lineas']);
        $Lineas           = new Lineas;
        $Lineas->nom_linea  = $FormData->nom_linea;
        $Lineas->cod_linea  = $FormData->cod_linea;
        $Lineas->inactivo = 0;
        $Lineas->save();
    }

    public function show()  {
        return view('generales.lineas');
    }

    public function update(Request $FormData)   {
        $this->validate( $FormData , ['nom_linea'=>'required']);
        $Lineas           = Lineas::findOrFail($FormData->id_linea );
        $Lineas->nom_linea  = $FormData->nom_linea;
        $Lineas->inactivo = $FormData->inactivo;
        $Lineas->update();
    }


    public function destroy($id) {
        $Lineas = Lineas::findOrFail($id );
        $Lineas->delete();
    }

}

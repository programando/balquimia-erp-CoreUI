<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MstroUndsMedida as UnidadesMedida;


class MstroUndsMedidaController extends Controller
{
    private $Page_Title;


    public function __construct(){
        $this->Page_Title = 'Unidades de Medida';
    }

    public function index() {
        $UnidadesMedida =  UnidadesMedida::orderBy('nom_med')->where('id_med','>','0')->paginate(10);
         return [
            'pagination' => [
                'total'        => $UnidadesMedida->total(),
                'current_page' => $UnidadesMedida->currentPage(),
                'per_page'     => $UnidadesMedida->perPage(),
                'last_page'    => $UnidadesMedida->lastPage(),
                'from'         => $UnidadesMedida->firstItem(),
                'to'           => $UnidadesMedida->lastItem(),
            ],
            'Registros' => $UnidadesMedida
        ];

    }


    public function showForm(){
        $Page_Title = $this->Page_Title;
        return view('productos.und-medida', compact('Page_Title'));
    }


    public function store(Request $FormData) {
        $this->validate( $FormData , ['nom_med'=>'required']);
        $UnidadMed           = new UnidadesMedida;
        $UnidadMed->nom_med  = $FormData->nom_med;
        $UnidadMed->inactivo = 0;
        $UnidadMed->save();
    }


    public function show()  {
        return view('productos.und-medida');
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

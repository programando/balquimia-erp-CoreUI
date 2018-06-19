<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MstroLinea as Lineas;

use DB;
class MstroLineasController extends Controller
{
     private $Page_Title;


    public function __construct(){

    }

    public function prueba(){
          //$Lineas = Lineas::with('SubLineas')->where('id_linea','=','3')->get();
         //$Lineas = Lineas::with('SubLineas')->where('id_linea','=','3')->get();
         /*$Lineas = Lineas::findOrFail('3');
         $Lineas->SubLineas()->sync([3,4,5,9,13]);
         $Lineas->save();
         dd( $Lineas );
         */
                 $Lineas =  Lineas::withCount('SubLineas')
                      ->with('SubLineas')
                      ->orderBy('nom_linea')
                      ->where('id_linea','>','0')
                      ->paginate(10);

         /*
         $Lineas =  Lineas::withCount('SubLineas')
                    ->with('SubLineas')
                    ->orderBy('nom_linea')->where('id_linea','>','0')->paginate(10);
                    */
         return $Lineas;
    }


    public function index() {

        $Lineas =  Lineas::with('SubLineas')
                      ->orderBy('nom_linea')
                      ->where('id_linea','>','0')
                      ->paginate(12);

        return $Lineas;
    }


    private function SubLineasGetFromRequest ( $FormData ){
        if ( empty( $FormData->sublineas))
            return array();
        $SubLineas = collect( $FormData->sublineas['data']);
        return  $SubLineas->pluck('id_sub_linea');
    }

    private function SubLineasSaveToLinea( $FormData,  $Lineas  ){
         $SubLineas  = $this->SubLineasGetFromRequest($FormData );
        if ( !empty( $SubLineas )){
                $Lineas->sublineas()->sync( $SubLineas );
        }
    }

    public function store(Request $FormData) {
        $this->validate( $FormData , ['nom_linea'=>'required', 'cod_linea' =>'required|unique:mstro_lineas']);
        $Lineas            = new Lineas;
        $Lineas->nom_linea = $FormData->nom_linea;
        $Lineas->cod_linea = $FormData->cod_linea;
        $Lineas->inactivo  = 0;
        $Lineas->save();
        /// GRABAR LAS SUBLINEAS ASOCIADAS
        $this->SubLineasSaveToLinea($FormData,  $Lineas );
    }


    public function update(Request $FormData)   {
        $this->validate( $FormData , ['nom_linea'=>'required']);
        $Lineas            = Lineas::findOrFail($FormData->id_linea );
        $Lineas->nom_linea = $FormData->nom_linea;
        $Lineas->inactivo  = $FormData->inactivo;
        $Lineas->update();
        /// GRABAR LAS SUBLINEAS ASOCIADAS
        $SubLineas  = $this->SubLineasGetFromRequest($FormData );
        if ( !empty( $SubLineas )){
                $Lineas->sublineas()->sync( $SubLineas );
        }

    }


    public function destroy($id) {
      try{
        DB::beginTransaction();
        $Lineas = Lineas::findOrFail($id );
        $Lineas->delete();
        DB::select("DELETE FROM mstro_lineas_sub_lineas_asoc WHERE id_linea=" . $id);
        DB::commit();
        }
        catch(\Exception $e ){
          DB::rollback();
          return "Errores en el borrado de lineas :" . $e->getMessage() . "\n";
        }
    }

    public function SubLineasBorrarAsocc( $IdSubLinea, $IdLinea ) {
       try{
        DB::beginTransaction();
            DB::select("DELETE FROM mstro_lineas_sub_lineas_asoc WHERE id_linea=" . $IdLinea . ' AND id_sub_linea=' . $IdSubLinea );
            DB::commit();
        }
        catch(\Exception $e ){
          DB::rollback();
          return "Errores en el borrado de lineas :" . $e->getMessage() . "\n";
        }
    }

}

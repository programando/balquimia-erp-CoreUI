<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\PedidosDt;
use Carbon\Carbon;
use DB;
/*
$post = App\Post::find(1);

$comment = $post->comments()->create([
    'message' => 'A new comment.',      Array
]);
*/
class PedidosController extends Controller
{

    public function DiasFinanciacion(){
        $DiasFinanciacion   = DB::select(' call ped_dias_financiacion() ');
        return $DiasFinanciacion;
    }

    public function Grabar( Request $FormData ){
      $this->validate($FormData ,
          ['id_terc_cli' => 'required|min:1', 'fcha_dspcho'=>'required']);

    try{
          DB::beginTransaction();
            $Pedido  = new Pedido;
            $Pedido->id_terc_cli = $FormData->id_terc_cli;
            $Pedido->id_terc_usu = User()->id_terc;
            $Pedido->fcha_ped    = Carbon::now();
            $Pedido->fcha_dspcho = Carbon::parse($FormData->fcha_dspcho);
            $Pedido->id_stdo     = 0;
            $Pedido->save();
            $DetallePedido =  $FormData->get('detalle');

            foreach($DetallePedido as $ep=>$datos)    {
                  $ItemDt = new PedidosDt();
                  $ItemDt->id_ped          = $Pedido->id_ped;
                  $ItemDt->id_prd          = $datos['id_prd'];
                  $ItemDt->cant            = $datos['cant'];
                  $ItemDt->vr_precio_lista = $datos['vr_precio_lista'];
                  $ItemDt->vr_flete        = $datos['vr_flete'];
                  $ItemDt->vr_fnacion      = $datos['vr_fnacion'];
                  $ItemDt->vr_precio_adic  = $datos['vr_precio_adic'];
                  $ItemDt->vr_dscto        = $datos['vr_dscto'];
                  $ItemDt->pcje_iva        = $datos['pcje_iva'];
                  $ItemDt->vr_iva          = $datos['vr_iva'];
                  $ItemDt->vr_unit_real    = $datos['vr_unit_real']/$datos['cant'];
                  $ItemDt->vt_tot_item     = $ItemDt->vr_unit_real  * $ItemDt->cant ;
                  $ItemDt->save();
              }
            DB::commit();
            return  $Pedido ;
        } catch (Exception $e){
            DB::rollBack();
             return  '!OK' ;
        }


    }


}

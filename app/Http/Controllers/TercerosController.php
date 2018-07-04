<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tercero as Terceros;

use DB;

class TercerosController extends Controller {

  public function ClientesFacturas(){
      //$Cliente = Terceros::with('Notas')->with('Contactos')->where('id_terc','4167')->get();
      //$Cliente = Terceros::with('Facturas.Detalle.Productos')->where('id_terc','4167')->get();

      return 'Ok';
  }

    public function ClientesLista(Request $FormData ){
        $Filtro =  $FormData->filtro;
        $Clientes = Terceros::where('cliente','=','1')
                    ->where('nom_sys','like', '%'.$Filtro .'%')
                    ->select('id_terc','nom_sys','nom_suc')
                    ->orderBy('nom_sys')->get();
        return  $Clientes;
    }

    public function VendedoresCliente ( Request $FormData ){
        $id_terc    = $FormData->id_terc;
        $Vendedores = DB::select(' call clientes_busca_vendedores (?)', array($id_terc));
        $Vendedores = collect($Vendedores);
        return $Vendedores;
    }

    public function Compras ( Request $FormData ){
        $id_terc = $FormData->id_terc;
        $Ventas  = DB::select(' call clientes_productos_comprados (?)', array($id_terc));
        $Ventas  = collect($Ventas);


        return $Ventas;
    }

    public function NotasVenta ( Request $FormData ){
        $id_terc = $FormData->id_terc;
        $Notas   = DB::select(' call terceros_notas_ventas_x_id_terc (?)', array($id_terc));
        $Notas   = collect($Notas);
        return $Notas;
    }


    public function NotasCartera ( Request $FormData ){
        $id_terc = $FormData->id_terc;
        $Notas   = DB::select(' call terceros_notas_cartera_x_id_terc (?)', array($id_terc));
        $Notas   = collect($Notas);
        return $Notas;
    }

    public function Contactos(Request $FormData ){
        $id_terc = $FormData->id_terc;
        $Contactos = DB::select(' call terceros_conctactos_x_id_terc (?)', array($id_terc));
        $Contactos   = collect($Contactos);
        return $Contactos;

    }


/*
        $filtro = $request->filtro;
        $proveedores = Proveedor::join('personas','proveedores.id','=','personas.id')
        ->where('personas.nombre', 'like', '%'. $filtro . '%')
        ->orWhere('personas.num_documento', 'like', '%'. $filtro . '%')
        ->select('personas.id','personas.nombre','personas.num_documento')
        ->orderBy('personas.nombre', 'asc')->get();

        return ['proveedores' => $proveedores];
        */

}

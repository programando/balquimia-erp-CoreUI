<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tercero as Terceros;


class TercerosController extends Controller
{

    public function ClientesLista(Request $FormData ){

        $Filtro = $FormData->filtro;
        $Clientes = Terceros::where('cliente','=','1')
                    ->where('nom_terc','like', '%'.$Filtro .'%')->get();
        return  $Clientes;
    }

        public function ClientesLista1( ){
            $Clientes = Terceros::all();
            return $Clientes;
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

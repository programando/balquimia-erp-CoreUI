<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Producto as Productos;
use App\Models\ProductosPresentacione as Presentaciones;

class ProductosController extends Controller
{
    public function ProductosBusqueda(Request $FormData ){
        $Filtro =  $FormData->filtro;
        if ( !$Filtro ){
            $Productos = Productos::with('Presentaciones')
                 ->where('inactivo','=','0')
                 ->where('presentaciones.vr_precio_lista','>',0)
                 ->select('id_prd_ppal','nom_prd')
                 ->orderBy('nom_prd')->take(10)->get();
        }else {
          $Productos = Terceros::where('cliente','=','1')
                      ->where('nom_sys','like', '%'.$Filtro .'%')
                      ->orWhere('nom_suc','like', '%'.$Filtro .'%')
                      ->orWhere('nro_identif','like', '%'.$Filtro .'%')
                      ->select('nro_identif','id_terc','nom_sys','nom_suc')
                      ->orderBy('nom_sys')->get();
            }
        return  $Productos;

   return User::select(\DB::raw(
                'users.id as "dtRowId", owners.name as owner, users.first_name, users.last_name, users.phone,
                users.email, roles.name as role, users.is_active'
            ))->join('owners', 'users.owner_id', '=', 'owners.id')
            ->join('roles', 'users.role_id', '=', 'roles.id');

    }
}

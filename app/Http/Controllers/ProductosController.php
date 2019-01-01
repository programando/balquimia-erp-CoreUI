<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Producto as Productos;
use App\Models\ProductosPresentacione as Presentaciones;
use DB;

class ProductosController extends Controller
{
    public function ProductosBusqueda(Request $FormData ){
        $Filtro =  $FormData->filtro;
        if ( !$Filtro ) {
            $Productos = Productos::select('productos.id_prd_ppal','PP.id_prd','productos.nom_prd','PP.vr_precio_lista',
                                'PRESENT.nom_present' )
                      ->join('productos_presentaciones as PP','productos.id_prd_ppal','=','PP.id_prd_ppal')
                      ->join('mstro_presentaciones as PRESENT', 'PP.id_present', '=', 'PRESENT.id_present')
                      ->where('PP.vr_precio_lista','>','0')
                      ->where('PP.inactivo','=','0')
                      ->orderBy('nom_prd')->take(10)->get();
              }
              else{
                  $Productos = Productos::NomPrdContiene( $Filtro )
                      ->select('productos.id_prd_ppal','PP.id_prd','productos.nom_prd','PP.vr_precio_lista',
                                'PRESENT.nom_present' )
                      ->join('productos_presentaciones as PP','productos.id_prd_ppal','=','PP.id_prd_ppal')
                      ->join('mstro_presentaciones as PRESENT', 'PP.id_present', '=', 'PRESENT.id_present')
                      ->where('PP.vr_precio_lista','>','0')
                      ->where('PP.inactivo','=','0')
                      ->orderBy('nom_prd')->get();
              }

        return $Productos;

    }
}

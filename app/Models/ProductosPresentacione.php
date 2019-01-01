<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductosPresentacione extends Model
{

  protected $primaryKey = 'id_prd';
  public $timestamps = false;

  protected $casts = [
    'id_prd_ppal' => 'int',
    'id_present' => 'int',
    'id_linea' => 'int',
    'id_marca' => 'int',
    'id_comis' => 'int',
    'id_subctg_mnv' => 'int',
    'costo' => 'float',
    'margen' => 'float',
    'peso_grm' => 'float',
    'peso_kg' => 'float',
    'actv_precio_lista' => 'bool',
    'vr_precio_lista' => 'float',
    'divs_precio' => 'float',
    'vr_vta_tron_hogar' => 'float',
    'vr_vta_ocas' => 'float',
    'vr_vta_tron' => 'float',
    'precio_mcdo_con_iva' => 'float',
    'prd_fbrcdo' => 'bool',
    'en_kardex' => 'bool',
    'es_kit' => 'bool',
    'en_oferta' => 'bool',
    'aplica_tron' => 'bool',
    'ver_web_tron' => 'bool',
    'ver_web_balq' => 'bool',
    'cobro_flete' => 'bool',
    'inactivo' => 'bool'
  ];

  protected $dates = [
    'vgcia_precio_lista'
  ];

  protected $fillable = [
    'id_prd_ppal',
    'id_present',
    'id_linea',
    'id_marca',
    'id_comis',
    'id_subctg_mnv',
    'costo',
    'margen',
    'peso_grm',
    'peso_kg',
    'actv_precio_lista',
    'vr_precio_lista',
    'vgcia_precio_lista',
    'divs_precio',
    'vr_vta_tron_hogar',
    'vr_vta_ocas',
    'vr_vta_tron',
    'precio_mcdo_con_iva',
    'prd_fbrcdo',
    'en_kardex',
    'es_kit',
    'en_oferta',
    'aplica_tron',
    'ver_web_tron',
    'ver_web_balq',
    'cobro_flete',
    'descrip_tron',
    'descrip_balq',
    'tags_bsqda',
    'inactivo'
  ];
       /*//////////////////////////////////////
            RELACIONES
       *//////////////////////////////////////
        public function GrupoComision()  {
          return $this->belongsTo(\App\Models\MstroComisionesPrd::class, 'id_comis');
        }

        public function Linea()  {
          return $this->belongsTo(\App\Models\MstroLinea::class, 'id_linea');
        }

        public function Marca()  {
          return $this->belongsTo(\App\Models\MstroMarca::class, 'id_marca');
        }

        public function ProductoPpal()  {
          return $this->belongsTo(\App\Models\Producto::class, 'id_prd_ppal');
        }

        public function Presentaciones()  {
          return $this->belongsTo(\App\Models\MstroPresentacione::class, 'id_present');
        }

        public function FacturasDt()  {
          return $this->hasMany(\App\Models\FacturasDt::class, 'id_prd');
        }
           /*//////////////////////////////////////
                SCOPES
           *//////////////////////////////////////
      public function scopeProductosActivos($query){
         return $query->where('inactivo','=','1');
      }

      public function scopeProductosConPrecio($query){
         return $query->where('vr_precio_lista', '>','0');
      }
}

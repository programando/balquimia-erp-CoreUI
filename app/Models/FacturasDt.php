<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacturasDt extends Model
{

  protected $table = 'facturas_dt';
  protected $primaryKey = 'id_fact_dt';
  public $timestamps = false;

  protected $casts = [
    'id_fact' => 'int',
    'id_terc_vend' => 'int',
    'id_prd' => 'int',
    'cant' => 'float',
    'vr_precio_lista' => 'float',
    'vr_flete' => 'float',
    'vr_fnacion' => 'float',
    'vr_precio_adic' => 'float',
    'vr_dscto' => 'float',
    'pcje_iva' => 'float',
    'vr_iva' => 'float',
    'vr_unit_real' => 'float',
    'vt_tot_item' => 'float'
  ];

  protected $fillable = [
    'id_fact',
    'id_terc_vend',
    'id_prd',
    'nro_hj_pn',
    'cant',
    'vr_precio_lista',
    'vr_flete',
    'vr_fnacion',
    'vr_precio_adic',
    'vr_dscto',
    'pcje_iva',
    'vr_iva',
    'vr_unit_real',
    'vt_tot_item'
  ];

  public function Factura()
  {
    return $this->belongsTo(\App\Models\Factura::class, 'id_fact');
  }

  public function Productos()
  {
    return $this->belongsTo(\App\Models\ProductosPresentacione::class, 'id_prd');
  }

  public function Vendedor()
  {
    return $this->belongsTo(\App\Models\Tercero::class, 'id_terc_vend');
  }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{

  protected $primaryKey = 'id_prd_ppal';
  public $timestamps = false;

  protected $casts = [
    'id_cta_vta' => 'int',
    'id_cta_inv' => 'int',
    'id_tp_prd' => 'int',
    'id_cls_dane_prd' => 'int',
    'id_med_cpra' => 'int',
    'densidad' => 'float',
    'mp_prda' => 'bool',
    'mp_ctrlda' => 'bool',
    'prestable' => 'bool',
    'accesorio' => 'bool',
    'inactivo' => 'bool'
  ];

  protected $fillable = [
    'clave',
    'id_cta_vta',
    'id_cta_inv',
    'id_tp_prd',
    'id_cls_dane_prd',
    'id_med_cpra',
    'nom_prd',
    'nom_faction',
    'fragancia',
    'tp_dspcho',
    'densidad',
    'mp_prda',
    'mp_ctrlda',
    'prestable',
    'accesorio',
    'inactivo'
  ];

  public function DaneGrupo()  {
    return $this->belongsTo(\App\Models\MstroDanePrdGrp::class, 'id_cls_dane_prd');
  }

  public function CtaVentas()  {
    return $this->belongsTo(\App\Models\MstroCtasPuc::class, 'id_cta_vta');
  }

    public function CtaInvet()  {
    return $this->belongsTo(\App\Models\MstroCtasPuc::class, 'id_cta_inv');
  }

  public function Medida()  {
    return $this->belongsTo(\App\Models\MstroUndsMedida::class, 'id_med_cpra');
  }

  public function TipoPrd()  {
    return $this->belongsTo(\App\Models\MstroTpsProducto::class, 'id_tp_prd');
  }

  public function Presentaciones()  {
    return $this->hasMany(\App\Models\ProductosPresentacione::class, 'id_prd_ppal');
  }

}

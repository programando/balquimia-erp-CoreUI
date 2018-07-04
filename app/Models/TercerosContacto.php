<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TercerosContacto extends Model
{

  protected $primaryKey = 'id_contacto';
  public $timestamps = false;

  protected $casts = [
    'id_terc' => 'int',
    'id_titulo' => 'int',
    'id_area_empsa' => 'int'
  ];

  protected $fillable = [
    'id_terc',
    'id_titulo',
    'id_area_empsa',
    'nom_contacto',
    'email',
    'nro_tel',
    'observ'
  ];

  public function AreaEmpresa()
  {
    return $this->belongsTo(\App\Models\MstroAreasEmpresa::class, 'id_area_empsa');
  }

  public function Tercero()
  {
    return $this->belongsTo(\App\Models\Tercero::class, 'id_terc');
  }

  public function TituloPersona()
  {
    return $this->belongsTo(\App\Models\MstroTituloPrsna::class, 'id_titulo');
  }
}

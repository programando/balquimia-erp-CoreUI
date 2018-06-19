<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MstroLineasSubLinea extends Model
{
  public    $timestamps = false;
  protected $primaryKey = 'id_sub_linea';
  protected $table      = 'mstro_lineas_sub_lineas';

  protected $casts = [ 'inactivo' => 'bool'  ];

  protected $fillable = [ 'nom_sub_linea',  'inactivo'  ];


  public function setNomSubLineaAttribute ( $value ){
      $value = TrimString ( $value,45);
      $this->attributes['nom_sub_linea'] = $value ;
  }




}

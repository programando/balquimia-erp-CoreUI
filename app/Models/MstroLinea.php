<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MstroLinea extends Model
{
  protected $primaryKey = 'id_linea';
  protected $table      ='mstro_lineas';
  public $timestamps    = false;

  protected $casts = [
    'orden' => 'int',
    'inactivo' => 'bool'
  ];

  protected $fillable = [
    'cod_linea',
    'nom_linea',
    'orden',
    'inactivo'
  ];

      public function setNomLineaAttribute ( $value ){
        $value = TrimString ( $value,25); // 49 Longitud del campo en la base de datos
        $value = mb_strtoupper( $value,'UTF-8');
        $this->attributes['nom_linea'] = $value ;
    }


  public function SubLineas() {
    return $this->hasMany(\App\Models\MstroLineasSubLinea::class, 'id_linea');
  }



}

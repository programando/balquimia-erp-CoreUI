<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MstroLineasSubLinea extends Model
{
  public    $timestamps = false;
  protected $primaryKey = 'id_sub_linea';
  protected $table      = 'mstro_lineas_sub_lineas';

  protected $casts = [
    'id_linea' => 'int',
    'inactivo' => 'bool'
  ];

  protected $fillable = [
    'id_linea',
    'nom_sub_linea',
    'inactivo'
  ];


  public function Linea() {
    return $this->belongsTo(\App\Models\MstroLinea::class, 'id_linea');
  }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MstroCargo extends Model
{
  protected $primaryKey = 'id_cargo';
  protected $table      = 'mstro_cargos';
  public    $timestamps = false;

  protected $casts = [
    'inactivo' => 'bool'
  ];

  protected $fillable = [
    'cod_cargo',
    'nom_cargo',
    'inactivo'
  ];


    public function setNomCargoAttribute ( $value ){
        $value = TrimString ( $value,49);
        $this->attributes['nom_cargo'] = $value ;
    }

}

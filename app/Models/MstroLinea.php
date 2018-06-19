<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MstroLinea extends Model
{
  public    $timestamps   =  false;

  protected $casts      = [ 'orden' => 'int',   'inactivo' => 'bool' ];
  protected $fillable   = [ 'cod_linea', 'nom_linea', 'orden', 'inactivo' ];
  protected $primaryKey = 'id_linea';
  protected $table      = 'mstro_lineas';

    public function setNomLineaAttribute ( $value ){
        $value = TrimString ( $value,25);
        $this->attributes['nom_linea'] = $value ;
    }

    public function setCodLineaAttribute ( $value ){
        $value = TrimString ( $value,4);
        $this->attributes['cod_linea'] = $value ;
    }

  public function SubLineas() {
    return
        $this->belongsToMany(\App\Models\MstroLineasSubLinea::class,
                                'mstro_lineas_sub_lineas_asoc',
                                'id_linea',
                                'id_sub_linea');
  }


}

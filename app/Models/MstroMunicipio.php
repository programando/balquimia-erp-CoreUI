<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MstroMunicipio extends Model
{

  protected $primaryKey = 'id_mcpio';
  public $timestamps = false;

  protected $casts = [
            'id_dpto'  => 'int',
            'zn_vta'   => 'bool',
            'mnv'      => 'bool',
            'inactivo' => 'bool'
          ];

  protected $fillable = [
          'id_dpto',
          'cod_mcpio',
          'nom_mcpio',
          'zn_vta',
          'cod_dane',
          'doc_dian',
          'mnv',
          'inactivo'
        ];

    public function Departamento() {
      return $this->belongsTo(\App\Models\MstroDpto::class, 'id_dpto');
    }

    public function ZonaVenta() {
      return $this->hasMany(\App\Models\Tercero::class, 'id_zn_vta');
    }

    public function Municipio() {
      return $this->hasMany(\App\Models\Tercero::class, 'id_mcpio');
    }


}

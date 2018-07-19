<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MstroPresentacione extends Model
{

  protected $primaryKey = 'id_present';
  public $timestamps = false;

  protected $casts = [
    'capac_volum' => 'float',
    'cant_und_empque' => 'int',
    'mnv' => 'bool',
    'inactivo' => 'bool'
  ];

  protected $fillable = [
    'nom_present',
    'capac_volum',
    'cant_und_empque',
    'descrip',
    'mnv',
    'inactivo'
  ];

  public function Presentacion() {
    return $this->hasMany(\App\Models\ProductosPresentacione::class, 'id_present');
  }

}

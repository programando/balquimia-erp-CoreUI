<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TercerosNota extends Model
{
    protected $primaryKey = 'id_terc_nota';
  public $timestamps = false;

  protected $casts = [
    'id_terc' => 'int'
  ];

  protected $dates = [
    'fcha_nota'
  ];

  protected $fillable = [
    'id_terc',
    'fcha_nota',
    'generales',
    'ventas',
    'cartera',
    'contab',
    'compras',
    'produccion',
    'empaque'
  ];

  public function Tercero()
  {
    return $this->belongsTo(\App\Models\Tercero::class, 'id_terc');
  }
}

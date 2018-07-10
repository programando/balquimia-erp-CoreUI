<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MstroPedidosEstado extends Model
{
    protected $primaryKey = 'id_stdo';
    public $timestamps = false;

  protected $casts = [  'inactivo' => 'bool'  ];

  protected $fillable = [  'nom_stdo',  'inactivo'
  ];

  public function Pedido()
  {
    return $this->hasMany(\App\Models\Pedido::class, 'id_stdo');
  }

}

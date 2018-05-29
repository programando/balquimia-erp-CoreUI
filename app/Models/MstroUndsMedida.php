<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MstroUndsMedida extends Model
{
     protected $table      ='mstro_unds_medidas';
     protected $primaryKey = 'id_med';
     public $timestamps    = false;


    protected $casts = [
     'inactivo' => 'bool'
    ];

    protected $fillable = [
     'nom_med', 'inactivo'
    ];
}

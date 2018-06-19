<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MstroLineasSubLineasAsoc extends Model
{
    protected $casts       = [  'id_linea' => 'int',  'id_sub_linea' => 'int'  ];
    protected $fillable    = [ 'id_linea',  'id_sub_linea'  ];
    protected $primaryKey  = 'id';
    protected $table       = 'mstro_lineas_sub_lineas_asoc';


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tercero extends Model
{
   protected $fillable   = ['nom_terc'];
   protected $hiden      = ['id_terc'];
   protected $primaryKey = 'id_terc';
   protected $table      = 'Terceros' ;

}

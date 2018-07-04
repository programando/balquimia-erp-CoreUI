<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    public $timestamps    = false;
    protected $primaryKey = 'id_fact';
    protected $table      ='facturas';
    protected $dates      = [  'fcha_fact',  'fcha_inactivo' ];

  protected $casts = [
    'id_rslcion'          => 'int',       'id_ped'              => 'int',       'num_fact'            => 'int',
    'id_terc_cli'         => 'int',       'id_terc_usu'         => 'int',      'id_terc_trnspdor'    => 'int',
    'plazo_fact'          => 'int',       'vr_subtotal'         => 'float',    'pcje_dscto'          => 'float',
    'vr_dscto'            => 'float',     'vr_flete'            => 'float',    'vr_base_impto'       => 'float',
    'vr_iva'              => 'float',     'vr_tot_fact'         => 'float',     'inactivo'            => 'bool',
    'id_terc_usu_inactvo' => 'int',       'cto_ok'              => 'bool',      'mnv'                 => 'bool',
    'revisado'            => 'bool'
  ];


  protected $fillable = [ 'id_rslcion',        'id_ped',         'num_fact',        'fcha_fact',          'id_terc_cli',
    'id_terc_usu',        'id_terc_trnspdor',  'nro_guia',        'plazo_fact',      'num_ordcpra',       'num_remis',
    'observ_fact',         'vr_subtotal',       'pcje_dscto',     'vr_dscto',         'vr_flete',         'vr_base_impto',
    'vr_iva',              'vr_tot_fact',       'inactivo',       'id_terc_usu_inactvo',     'fcha_inactivo',
    'mtivo_inactivo',      'cto_ok',            'mnv',             'revisado'  ];

    public function Resolucion() {
      return $this->belongsTo(\App\Models\FacturasResolucione::class, 'id_rslcion');
    }



    public function Usuario() {
      return $this->belongsTo(\App\Models\Tercero::class, 'id_terc_usu');
    }

    public function Transportador() {
      return $this->belongsTo(\App\Models\Tercero::class, 'id_terc_trnspdor');
    }

    public function UsuarioInactiva() {
      return $this->belongsTo(\App\Models\Tercero::class, 'id_terc_usu_inactvo');
    }

    public function Cliente() {
      return $this->belongsTo(\App\Models\Tercero::class, 'id_terc_cli');
    }

    public function Detalle() {
      return $this->hasMany(\App\Models\FacturasDt::class, 'id_fact');
    }

}

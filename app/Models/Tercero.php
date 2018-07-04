<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tercero extends Model
{

  protected $primaryKey = 'id_terc';
  public    $timestamps = false;

  protected $casts = [
    'id_tp_doc'         => 'int',         'id_mcpio'          => 'int',        'cliente'           => 'bool',
    'id_zn_vta'         => 'int',         'id_linea_cli'      => 'int',        'id_sub_linea_cli'  => 'int',
    'plazo_fact'        => 'int',         'cupo'              => 'float',      'dia_max_fact'      => 'bool',
    'auto_rete'         => 'bool',        'gran_cbuye'        => 'bool',       'id_terc_vend_ppal' => 'int',
    'id_terc_vend_secd' => 'int',         'cbte_prest'        => 'bool',       'certf_ansis'       => 'bool',
    'remision'          => 'bool',        'excento_iva'       => 'bool',       'rte_fte'           => 'bool',
    'rte_iva'           => 'bool',        'rte_ica'           => 'bool',       'rte_cree'          => 'bool',
    'terc_mnv'          => 'bool',        'id_terc_padre'     => 'int',        'proveedor'         => 'bool',
    'transpdor'         => 'bool',        'prov_eps'          => 'bool',       'prov_arp'          => 'bool',
    'prov_afp'          => 'bool',        'prov_csant'        => 'bool',       'prov_caja'         => 'bool',
    'empleado'          => 'bool',        'liq_nomi'          => 'bool',       'usuario'           => 'bool',
    'vend'              => 'bool',        'vend_free'         => 'bool',       'transp_prd'        => 'bool',
    'vr_sueldo'         => 'float',       'vr_aux_alim'       => 'float',      'vr_aux_cel'        => 'float',
    'vr_aux_vehic'      => 'float',       'vr_aux_transp'     => 'float',      'id_terc_eps'       => 'int',
    'id_terc_afp'       => 'int',         'id_terc_arp'       => 'int',        'id_terc_csant'     => 'int',
    'id_terc_caja'      => 'int',         'id_nv_rsgo'        => 'int',        'inactivo'          => 'bool',
    'id_cargo'          => 'int',         'id_linea_vend'     => 'int',        'id_cls_pyg'        => 'int',
    'pje_comis'         => 'float',       'listados'          => 'bool',       'revisado'          => 'bool'
  ];

  protected $dates = [ 'fcha_ing',  'fcha_cupo',  'fcha_nace',  'fcha_retiro'  ];

  protected $fillable = [
    'nro_identif',            'dv',                'id_tp_doc',            'pnombre',            'snombre',
    'papellido',              'sapellido',        'razon_soc',            'nom_ccial',          'nom_suc',
    'nom_fact',               'nom_sys',           'id_mcpio',             'direcc',             'direcc_dpcho',
    'nro_tel',                'email',              'cliente',              'id_zn_vta',         'id_linea_cli',
    'id_sub_linea_cli',       'fcha_ing',           'plazo_fact',           'cupo',              'fcha_cupo',
    'dia_max_fact',           'tp_persona',         'auto_rete',            'gran_cbuye',        'regimen',
    'id_terc_vend_ppal',      'id_terc_vend_secd',  'cod_ciiu',              'actv_ica',          'cbte_prest',
    'certf_ansis',            'remision',           'excento_iva',           'rte_fte',           'rte_iva',
    'rte_ica',                'rte_cree',           'terc_mnv',              'id_terc_padre',     'proveedor',
    'transpdor',              'prov_eps',           'prov_arp',               'prov_afp',         'prov_csant',
    'prov_caja',              'empleado',           'liq_nomi',               'usuario',          'vend',
    'vend_free',              'cod_vend',           'transp_prd',             'fcha_nace',        'vr_sueldo',
    'vr_aux_alim',            'vr_aux_cel',         'vr_aux_vehic',           'vr_aux_transp',     'id_terc_eps',
    'id_terc_afp',            'id_terc_arp',         'id_terc_csant',        'id_terc_caja',      'id_nv_rsgo',
    'inactivo',               'fcha_retiro',         'id_cargo',              'id_linea_vend',     'id_cls_pyg',
    'nom_vend_fact',           'pje_comis',          'listados',              'file_firma',         'revisado'
  ];

/*
  $beneficiarios = Departamento::whereHas('municipio', function($q) {
      $q->where('departamento_id', Input::get('depto'));
  })
  ->with(['corregimiento', 'barrio', 'beneficiario'])
  ->get();
*/


  public function Cargo(){
    return $this->belongsTo(\App\Models\MstroCargo::class, 'id_cargo');
  }

  public function ClaseEmpleadoPyg() {
    return $this->belongsTo(\App\Models\MstroNominaPygClase::class, 'id_cls_pyg');
  }

  public function Linea()  {
    return $this->belongsTo(\App\Models\MstroLinea::class, 'id_linea_vend');
  }

  public function ZonaVentas()  {
    return $this->belongsTo(\App\Models\MstroMunicipio::class, 'id_zn_vta');
  }

    public function Municipio()  {
    return $this->belongsTo(\App\Models\MstroMunicipio::class, 'id_mcpio');
  }

  public function NivelRiesgo()  {
    return $this->belongsTo(\App\Models\MstroNvsRiesgo::class, 'id_nv_rsgo');
  }

  public function SubLinea()  {
    return $this->belongsTo(\App\Models\MstroLineasSubLinea::class, 'id_sub_linea_cli');
  }

  public function TipoDocumento()  {
    return $this->belongsTo(\App\Models\MstroTpsDoc::class, 'id_tp_doc');
  }

  public function Contactos()  {
    return $this->hasMany(\App\Models\TercerosContacto::class, 'id_terc');
  }

  public function Notas()  {
    return $this->hasMany(\App\Models\TercerosNota::class, 'id_terc');
  }

  public function Usuario()  {
    return $this->hasOne(\App\Models\TercerosUser::class, 'id_terc');
  }



  public function Facturas()
  {
    return $this->hasMany(\App\Models\Factura::class, 'id_terc_cli','id_terc');
  }

  public function FactDtVendedor()
  {
    return $this->hasMany(\App\Models\FacturasDt::class, 'id_terc_vend');
  }






}






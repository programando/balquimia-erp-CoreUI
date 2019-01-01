<template>
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <i class="fa fa-align-justify"></i> Registro de Pedidos
                  </div>

                  <div class="card-body">
                     <form action="" method="post" enctype="multipart/form-data"
                            @keydown="ErrorsClear($event.target.name)"
                            @Onchange="ErrorsClear($event.target.name)" >

                        <div class="row">

                          <div class="col-sm-3" >
                          <label for="name">Cliente</label>
                            <div class="form-group form-inline" :class = "{ 'is-invalid': ErrorHas('id_terc_cli')}">

                          <button @click.prevent.default="ModalOpen()"  class="btn btn-primary btn-sm"><i class="fa fa-search"></i> </button>

                            &nbsp;  <input v-model="NombreCliente"  class="form-control" placeholder="Seleccione un cliente" style="width: 85%;" disabled="disabled">
                             <!-- <label for="name">Cliente</label>
                                 <selectsearch
                                      UrlSearch        ='/clientes/buscar'
                                      @AsignarIdTercero="AsignarIdTercero">
                                  </selectsearch>
                                -->
                                  <div style="color: red;" v-if="ErrorHas('id_terc_cli')"><i class="fa  fa-hand-o-right" ></i>
                                        <label class="" v-text="ErrorGet('id_terc_cli')"> </label>
                                  </div>

                            </div>
                          </div>

                          <div class="col-sm-3">
                            <div class="form-group">
                              <label for="name">Sucursal</label>
                              <input type="text" class="form-control"  disabled="disabled" v-model="nom_suc">
                            </div>
                          </div>

                          <div class="col-sm-2">
                            <div class="form-group">
                              <label for="name">Vendedor</label>
                              <input type="text" class="form-control"  disabled="disabled" v-model="nom_vend_ppal">
                            </div>
                          </div>

                          <div class="col-sm-2">
                            <div class="form-group" :class = "{ 'is-invalid': ErrorHas('fcha_dspcho')}">
                              <label for="name">Fecha Despacho</label>
                              <datepicker v-model="fcha_dspcho"  :language="es" :format="FormatoFechaPicker"
                              :bootstrap-styling="true">
                              </datepicker>
                               <div style="color: red;" v-if="ErrorHas('fcha_dspcho')">
                                    <i class="fa  fa-hand-o-right" ></i>
                                    <label class="" v-text="ErrorGet('fcha_dspcho')"> </label>
                               </div>
                            </div>
                          </div>

                          <div class="col-sm-2">
                            <div class="form-group">
                              <label for="name">Financiación</label>

                               <v-select v-model="PedDiasFnacionSel" :options="PedDiasFnacion"
                                  label       ="tiempo"
                                  :change     ='CalcularFinanciacion'
                                   placeholder=""    >
                                <span slot="no-options"></span>
                               </v-select>
                            </div>
                          </div>
                        </div> <!--/.row Primera fila - cliente, fecha-->
                        <div class="row">
                          <div class="col-sm-1">
                            <div class="form-group">
                              <label for="ccnumber">Prom.Pago</label>
                              <input type="text" class="form-control" id="ccnumber" >
                            </div>
                          </div>
                         <div class="col-sm-2">
                            <div class="form-group">
                              <label for="ccnumber">Nro.Ord.Cpra.</label>
                              <input type="text" class="form-control" id="ccnumber" >
                            </div>
                          </div>
                         <div class="col-sm-9">
                            <div class="form-group">
                              <label for="ccnumber">Observaciones Pedido</label>
                              <input type="text" class="form-control" id="ccnumber" >
                            </div>
                          </div>
                        </div>  <!--/.row 2 fila - Promedio pago-->
                    </form>
                      <div class="row">
                        <div class="col-sm-12">
                          <!--Titulos Tabs -->
                          <ul class="nav nav-tabs" id="myTab1" role="tablist">
                              <li class="nav-item">
                                <a class="nav-link active"   data-toggle="tab" href="#ventas" role="tab"  aria-selected="true">Últimas Ventas</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link"  data-toggle="tab" href="#nuevopedido" role="tab"  aria-selected="false">Pedido Generado</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link"  data-toggle="tab" href="#contact" role="tab" aria-selected="false">Estado de cuenta</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link"   data-toggle="tab" href="#observ_ventas" role="tab" aria-selected="false">Observaciones Ventas</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link"   data-toggle="tab" href="#observ_cartera" role="tab" aria-selected="false">Observaciones Cartera</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link"   data-toggle="tab" href="#contactos" role="tab" aria-selected="false">Contactos</a>
                              </li>
                          </ul> <!--/Titulos Tabs -->

                          <!--Contenedor Tabs -->
                          <div class="tab-content" id="myTab1Content">

                            <div class="tab-pane fade show active" id="ventas" role="tabpanel" aria-labelledby="home-tab">
                                <clientesprdcomprados :Compras ="Compras" @AgregarProductoPedido="AgregarProductoPedido"></clientesprdcomprados>
                            </div>

                            <div class="tab-pane fade" id="nuevopedido" role="tabpanel" aria-labelledby="profile-tab">

                             <button type="button" class="btn btn-sm btn-success" style="margin: 2px;"
                                  ><i class="fa  fa-save" ></i> Agregar Productos </button>
                             <button v-if="NuevoPedido.length > 0" type="button" class="btn btn-sm btn-primary pull-right" style="margin: 2px;"
                                  @click="GrabarPedido()"><i class="fa  fa-save" ></i> Grabar Pedido </button>
                             <div v-if="NuevoPedido.length > 0">



                              <table class="table table-responsive-sm table-bordered table-striped table-sm">
                                <thead>
                                  <tr>
                                    <th></th>
                                    <th> Producto</th>
                                    <th> Present.</th>
                                    <th> Cant</th>
                                    <th> $ Base</th>
                                    <th> Flete</th>
                                    <th> Financ.</th>
                                    <th> Mayor Vr.</th>
                                    <th> Dscto</th>
                                    <th> Vr.Unit.</th>
                                    <th> Vr.Unit.</th>

                                  </tr>
                                </thead>
                                <tbody>
                                  <tr v-for="(Pedido, index) in NuevoPedido" :key="Pedido.id_fact_dt">
                                    <td class="text-center">
                                       <button type="button" class="btn btn-danger btn-sm"  @click="ProductoBorrar(index)" title="Eliminar producto">
                                        <i class="fa fa-trash-o" ></i>
                                    </button> &nbsp;

                                    </td>
                                   <td v-text="Pedido.nom_prd"> </td>
                                   <td> {{ Pedido.descrip  }} </td>

                                   <td class="text-right ">
                                     <input class="text-center" type="number" min="1" step="1" v-model="Pedido.cant" style="width: 40px;"
                                            @blur="ValidarCantidad(Pedido)">
                                   </td>

                                   <td class="text-right"> {{ Pedido.vr_precio_lista | NumeroEntero  }} </td>

                                   <td class="text-right ">
                                     <input class="text-center"  v-model="Pedido.vr_flete" style="width: 70px;" @blur="ValidarFlete(Pedido)">
                                   </td>

                                   <td class="text-right"> {{ Pedido.vr_fnacion      | NumeroEntero  }} </td>

                                   <td class="text-right ">
                                     <input class="text-center"   v-model="Pedido.vr_precio_adic" style="width: 70px;" >
                                   </td>

                                   <td class="text-right"> {{ Pedido.vr_dscto        | NumeroEntero  }} </td>
                                   <td class="text-right"> {{ Pedido.vr_unit_real/ Pedido.cant   | NumeroEntero  }} </td>
                                   <td class="text-right">
                                     {{ Pedido.vr_unit_real= ( Pedido.vr_precio_lista * Pedido.cant) +
                                      ( parseFloat(Pedido.vr_flete       * Pedido.cant)) +        parseFloat(Pedido.vr_fnacion * Pedido.cant) +
                                      parseFloat(Pedido.vr_precio_adic * Pedido.cant)  -        parseFloat(Pedido.vr_dscto   * Pedido.cant)
                                      | NumeroEntero }}
                                    </td>


                                  </tr>
                                </tbody>
                                <tr>
                                  <td colspan="9"></td>
                                  <td class="text-right">   <strong> Sub-Total </strong> </td>
                                  <td class="text-right">   <strong> {{ PedVrSubtotal=CalcularSubTotal  | NumeroEntero }} </strong> </td>
                                </tr>
                                <tr>
                                  <td colspan="9"></td>
                                  <td class="text-right">   <strong> Descuento:
                                    <input class="text-center" type="number" min="1"  step="1" v-model="PedPcjeDscto" style="width: 30px;" @blur="ValidarDsctoGlobal()">&nbsp;%
                                  </strong>
                                </td>
                                <td class="text-right">   <strong> {{ PedVrDscto=CalcularDescuento  | NumeroEntero }} </strong> </td>
                              </tr>
                              <tr>
                                <td colspan="9"></td>
                                <td class="text-right">   <strong> Fletes </strong> </td>
                                <td class="text-right" style="width: 25px;">   <strong>
                                  <input class="text-right"   v-model="PedVrFletes" style="width: 80px;" @blur="ValidarFleteGlobal()"> </strong> </td>
                                </tr>
                                <tr>
                                  <td colspan="9"></td>
                                  <td class="text-right">   <strong> Iva </strong> </td>
                                  <td class="text-right">   <strong> {{ PedVrIva=CalcularIva  | NumeroEntero }}  </strong> </td>
                                </tr>
                                <tr>
                                  <td colspan="9"></td>
                                  <td class="text-right">   <strong> Total Pedido </strong> </td>
                                  <td class="text-right">   <strong> {{ PedVrTotPed=CalcularTotalPedido  | NumeroEntero }} </strong> </td>
                                </tr>

                              </table>
                              </div>
                              <div class="col-sm-12 text-center" v-else>
                                  <br><br>
                                  <h4>No se han seleccionado productos para incluir en el pedido</h4><br><br>
                              </div>

                            </div>

                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                   Información de Cartera ( Pendiente )
                            </div>

                               <div class="tab-pane fade" id="observ_ventas" role="tabpanel" aria-labelledby="contact-tab">
                                   <tercerosnotasventas :NotasVentas = "NotasVentas"> </tercerosnotasventas>
                               </div>

                              <div class="tab-pane fade" id="observ_cartera" role="tabpanel" aria-labelledby="contact-tab">
                                  <tercerosnotascartera :NotasCartera = "NotasCartera"> </tercerosnotascartera>
                             </div>

                             <div class="tab-pane fade " id="contactos" role="tabpanel" aria-labelledby="home-tab">
                                <terceroscontactos :Contactos ="Contactos"></terceroscontactos>
                            </div>

                          </div> <!-- /Contenedor Tabs -->
                        </div>
                      </div> <!-- /Row de las tabs -->

                     </div> <!-- /Card body-->

              </div>    <!-- /Card -->
          </div>        <!-- /Col-->
      </div>            <!-- row-->
        <tercerosBuscar :ModalClie="ModalShow" @AsignarIdTercero="AsignarIdTercero" UrlBusqueda='/clientes/buscar/'></tercerosBuscar>

    </div>              <!-- /animated -->
  </template>

<script>
import FormValidation  from '../../mixins/FormValidation';
import Modals          from '../../mixins/Modals';
import {MSG }          from '../../messages.js';

import Datepicker      from 'vuejs-datepicker';
import { es }          from 'vuejs-datepicker/dist/locale'
import vSelect         from 'vue-select';
//import Formato        from '../mixins/FormatoNum';

var moment = require('moment');
moment.locale('es');

  export default {
      mounted(){
          this.TiemposFinanciacionConsulta();
          this.ModalShow = 0;
      },
      data(){
          return {
              ErrorsController  : {},
              Compras       : [],
              NotasVentas   : [],
              NotasCartera  : [],
              Contactos     : [],
              NuevoPedido   : [],
              NombreCliente : '',
              id_terc       : 0,
              nom_vend_ppal :'',
              fcha_dspcho   : '',
              nom_suc       : '',
              es            : es,
              PedVrSubtotal   : 0,
              PedPcjeDscto    : 0.00,
              PedVrDscto      : 0.0,
              PedVrFletes     : 0.0,
              PedPcjeIva      : 0.00,
              PedVrIva        : 0.0,
              PedVrTotPed     : 0.0,
              PedDiasFnacion        : [],
              PedDiasFnacionSel     : {id_fnacion:0,pcje_fnacion:0,tiempo:'0 Días' ,dias:0 },
              PedDiasFnacionPcje    :0,
        }
      },


      mixins: [ FormValidation, Modals ],

      components: {
        Datepicker,vSelect
      },

      computed:{
        CalcularSubTotal() {
            var pcje_fnacion = 0.0;
            var SubTotal     = 0;
            pcje_fnacion     = parseFloat(this.PedDiasFnacionSel.pcje_fnacion);
            this.NuevoPedido.forEach((item) => {
                  if ( pcje_fnacion == 0 ){
                    item.vr_fnacion = 0;
                  }
                  if ( pcje_fnacion < 1 && pcje_fnacion != 0 ){
                      item.vr_fnacion =  parseFloat(item.vr_precio_lista/pcje_fnacion) - parseFloat(item.vr_precio_lista) ;
                    }
                  if ( pcje_fnacion > 1){
                      item.vr_fnacion =  parseFloat(item.vr_precio_lista*pcje_fnacion) - parseFloat(item.vr_precio_lista) ;
                    }
             });
             
            this.NuevoPedido.forEach((item) => {
                    SubTotal += parseFloat(item.cant * item.vr_precio_lista)   +
                                ( parseFloat(item.vr_flete       * item.cant)) +        parseFloat(item.vr_fnacion * item.cant) +
                                  parseFloat(item.vr_precio_adic * item.cant)  -        parseFloat(item.vr_dscto   * item.cant);
             });
             return SubTotal;
          },
        CalcularDescuento(){
          return parseFloat(this.PedVrSubtotal * ( parseFloat(this.PedPcjeDscto)/100));
          },
        CalcularIva(){
          return (parseFloat(this.PedVrSubtotal) - parseFloat(this.PedVrDscto) + parseFloat(this.PedVrFletes)) * parseFloat(this.PedPcjeIva /100);
          },
        CalcularTotalPedido(){
            return parseFloat(this.PedVrSubtotal) - parseFloat(this.PedVrDscto) + parseFloat(this.PedVrFletes) + parseFloat(this.PedVrIva);
          },

      },

      methods: {
          TiemposFinanciacionConsulta(){
              let Me = this;
              axios.get('/pedido/dias/financiacion')
              .then( response=>{
                  Me.PedDiasFnacion = response.data;
              })
              .catch(this.ErrorOnFail );
          },
          CalcularFinanciacion(){

          },

          ClearFields(){
          },
          ProductoBorrar( index ){
              this.NuevoPedido.splice(index,1);
          },
          AsignarIdTercero( Tercero){
              this.NuevoPedido = [];
              this.id_terc     =    Tercero.id_terc;    //IdClienteSelecionado;
              this.NombreCliente = Tercero.nom_sys;
              this.BuscarVendedores();
              this.BuscarCompras();
              this.BuscarNotasVenta();
              this.BuscarNotasCartera();
              this.BuscarContactos();
              this.ErrorsClear('id_terc_cli');
              this.ModalClose();
          },
          BuscarVendedores(){
              let Me  = this;
              let Url = '/clientes/vendedores/'+ '?id_terc='+this.id_terc;
              let DatosCliente ='';
              axios.get( Url )
                .then( response => {
                    DatosCliente = response.data.Cliente;
                    Me.nom_vend_ppal = response.data.Vendedores[0].nom_vend_ppal;
                    Me.nom_suc       = DatosCliente.municipio.nom_mcpio.trim() + ' Suc: ' + DatosCliente.nom_suc.trim() ;
                })
                .catch( this.ErrorOnFail  );
          },
          BuscarCompras(){
            let Me = this;
            let Url = '/clientes/compras' + '?id_terc='+this.id_terc;
            axios.get( Url )
              .then( response =>{
                  Me.Compras = response.data;
              })
              .catch( this.ErrorOnFail );
          },
          BuscarNotasVenta(){
             let Me = this;
            let Url = '/terceros/notas/ventas' + '?id_terc='+this.id_terc;
            axios.get( Url )
              .then( response =>{
                  Me.NotasVentas = response.data;
              })
              .catch( this.ErrorOnFail );
          },
          BuscarNotasCartera(){
             let Me = this;
            let Url = '/terceros/notas/cartera' + '?id_terc='+this.id_terc;
            axios.get( Url )
              .then( response =>{
                  Me.NotasCarteras = response.data;
              })
              .catch( this.ErrorOnFail );
          },
          BuscarContactos(){
             let Me = this;
            let Url = '/terceros/contactos' + '?id_terc='+this.id_terc;
            axios.get( Url )
              .then( response =>{
                  Me.Contactos = response.data;
              })
              .catch( this.ErrorOnFail );
          },

          ProductoExisteEnPedido( id_prd ){
            var Existe = false;
            this.NuevoPedido.forEach((item) => {
                 if ( item.id_prd == id_prd ){
                   Existe = true;
                 }
             });
            if ( Existe == true ){
                 this.$swal(MSG.Reg_Doble_Tit, MSG.Ped_Prd_Doble, 'info')
                }
             return Existe;
          },

          AgregarProductoPedido( data ){
              if (this.ProductoExisteEnPedido( data.id_prd ) == true ){
                return 'ok';
              }
              this.PedPcjeIva = data.pcjeiva;
              var newItem = {
                  id_prd          : data.id_prd,
                  nom_prd         : data.nom_prd,
                  cant            : JSON.parse(data.cant).toFixed(0),
                  vr_precio_lista : data.vr_precio_lista_hoy,
                  descrip         : data.descrip,
                  id_fact_dt      : data.id_fact_dt,
                  vr_flete        : 0,
                  vr_fnacion      : 0,
                  vr_precio_adic  : 0,
                  vr_unit_real    : 0,
                  vr_dscto        : 0,
                  pcje_iva        : this.PedPcjeIva,
                  vr_iva          : 0,
              };
              this.NuevoPedido.push( newItem );
              toastr.success( MSG.Ped_Prd_Add);
          },
          GrabarPedido(){
            if ( this.ValidarDatos()== false ) { return false; }
            if ( this.ValidarDetalle()==false) { return false; }
            let Me = this;
            let Url = '/pedido/grabar';
            axios.post( Url,
              {'id_terc_cli'   : Me.id_terc,          'detalle'     : Me.NuevoPedido  ,    'fcha_dspcho' : Me.fcha_dspcho,
                'PedVrSubtotal': Me.PedVrSubtotal ,   'PedPcjeDscto': Me.PedPcjeDscto ,    'PedVrDscto'  : Me.PedVrDscto       ,
                'PedVrFletes'  : Me.PedVrFletes   ,   'PedPcjeIva'  : Me.PedPcjeIva   ,    'PedVrIva'    : Me.PedVrIva         ,
                'PedVrTotPed'  : Me.PedVrTotPed
                })
              .then( response => {
                  this.ReiniciarCampos();
                  toastr.success(MSG.Save_Reg_Ok );
              })
              .catch(this.ErrorOnFail );
          },

          FormatoFechaPicker(date) {
              return moment(date).format('DD-MMMM-YYYY');
          },
          ValidarDatos(){
            if ( this.id_terc == 0 ){
                toastr.error(MSG.Sel_Cliente);
                return false;
            }
          },
           ValidarCantidad( data=[]){
            if ( data.cant <= 0 )            { data.cant = 1;    }
          },
           ValidarFlete( data=[]){
            if ( data.vr_flete <= 0 )        { data.vr_flete = 0; }
          },
           ValidarDsctoGlobal( ){
            if ( this.PedPcjeDscto < 0 )        { this.PedPcjeDscto = 0; }
          },
           ValidarFleteGlobal( ){
            if ( this.PedVrFletes < 0 )        { this.PedVrFletes = 0; }
          },
          ValidarDetalle(){
            if (this.NuevoPedido.length== 0 ){
              this.$swal(MSG.Det_Null_Tit, MSG.Det_Null, 'info')
              return false;
            }else{
              return true;
            }
          },
          ModalOpen(){
              this.ModalShow  = 1;
              this.ReiniciarCampos();
          },
          ReiniciarCampos(){
              this.ErrorclearAll();
              this.ErrorsController    = {};
              this.Compras             = [];
              this.NotasVentas         = [];
              this.NotasCartera        = [];
              this.Contactos           = [];
              this.NuevoPedido         = [];
              this.NombreCliente       = '',
              this.ClientesEncontrados = [];
              this.TextoBsqda          = '';
              this.id_terc             = 0;
              this.nom_vend_ppal       ='';
              this.fcha_dspcho         = '';
              this.PedVrSubtotal       = 0;
              this.PedPcjeDscto        = 0.00;
              this.PedVrDscto          = 0.00;
              this.PedVrFletes         = 0.00;
              this.PedPcjeIva          = 0.00;
              this.PedVrIva            = 0.00;
              this.PedVrTotPed         = 0.00;
          }

    },// Methods


  };

</script>


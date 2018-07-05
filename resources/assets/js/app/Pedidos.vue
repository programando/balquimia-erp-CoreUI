<template>
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <i class="fa fa-align-justify"></i> Registro de Pedidos
                  </div>

                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-5">
                        <div class="form-group">
                          <label for="name">Cliente</label>

                         <selectsearch
                              UrlSearch        ='/clientes/buscar'
                              @AsignarIdTercero="AsignarIdTercero">
                          </selectsearch>

                        </div>
                      </div>

                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="name">Vendedor</label>
                          <input type="text" class="form-control" id="name" disabled="disabled" v-model="nom_vend_ppal">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="name">Fecha Despacho</label>
                          <datepicker v-model="fcha_dspcho"  :language="es" :format="FormatoFechaPicker"
                          :bootstrap-styling="true">
                          </datepicker>

                        </div>
                      </div>

                    </div>
                    <!--/.row-->

                    <div class="row">
                      <div class="col-sm-1">
                        <div class="form-group">
                          <label for="ccnumber">Prom.Pago</label>
                          <input type="text" class="form-control" id="ccnumber" >
                        </div>
                      </div>
                     <div class="col-sm-3">
                        <div class="form-group">
                          <label for="ccnumber">Nro.Ord.Cpra.</label>
                          <input type="text" class="form-control" id="ccnumber" >
                        </div>
                      </div>
                     <div class="col-sm-8">
                        <div class="form-group">
                          <label for="ccnumber">Observaciones Pedido</label>
                          <input type="text" class="form-control" id="ccnumber" >
                        </div>
                      </div>

                    </div>
                    <!--/.row-->
<div class="row">
     <div class="col-sm-12">

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

            </ul>
            <div class="tab-content" id="myTab1Content">
              <div class="tab-pane fade show active" id="ventas" role="tabpanel" aria-labelledby="home-tab">
                  <clientesprdcomprados :Compras ="Compras" @AgregarProductoPedido="AgregarProductoPedido"></clientesprdcomprados>
              </div>
              <div class="tab-pane fade" id="nuevopedido" role="tabpanel" aria-labelledby="profile-tab">
                <div>
                <button type="button" class="btn btn-sm btn-primary pull-right"   @click="GrabarPedido()"> Grabar Pedido</button>
                </div>
                <table class="table table-responsive-sm table-bordered table-striped table-sm">
                  <thead>
                    <tr>
                      <th> Producto</th>
                      <th> Present.</th>
                      <th> Cant</th>
                      <th> $ Base</th>
                      <th> Flete</th>
                      <th> Financ.</th>
                      <th> Mayor Vr.</th>
                      <th> Dscto</th>
                      <th> Vr.Unit.</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="Pedido in NuevoPedido" :key="Pedido.id_fact_dt">
                     <td v-text="Pedido.nom_prd"> </td>
                     <td> {{ Pedido.descrip  }} </td>

                     <td class="text-right ">
                       <input class="text-center" type="number" min="1" step="1" v-model="Pedido.cant" style="width: 40px;">
                     </td>

                     <td class="text-right"> {{ Pedido.vr_precio_lista | NumeroEntero  }} </td>

                     <td class="text-right ">
                       <input class="text-center"  v-model="Pedido.vr_flete" style="width: 70px;">
                     </td>

                     <td class="text-right"> {{ Pedido.vr_fnacion      | NumeroEntero  }} </td>

                     <td class="text-right ">
                       <input class="text-center"   v-model="Pedido.vr_precio_adic" style="width: 70px;">
                     </td>

                     <td class="text-right"> {{ Pedido.vr_dscto        | NumeroEntero  }} </td>
                     <td class="text-right">
                       {{ ( Pedido.vr_precio_lista * Pedido.cant) +
                        ( parseFloat(Pedido.vr_flete       * Pedido.cant)) +        parseFloat(Pedido.vr_fnacion * Pedido.cant) +
                        parseFloat(Pedido.vr_precio_adic * Pedido.cant)  -        parseFloat(Pedido.vr_dscto   * Pedido.cant)
                        | NumeroEntero }}
                      </td>
                    </tr>
                  </tbody>
                  <tr>
                    <td colspan="7"></td>
                    <td class="text-right">   <strong> Sub-Total </strong> </td>
                    <td class="text-right">   <strong> {{ PedVrSubtotal=CalcularSubTotal  | NumeroEntero }} </strong> </td>
                  </tr>
                  <tr>
                    <td colspan="7"></td>
                    <td class="text-right">   <strong> Descuento:
                      <input class="text-center" type="number" min="1"  step="1" v-model="PedPcjeDscto" style="width: 30px;">%
                    </strong>
                  </td>
                  <td class="text-right">   <strong> {{ PedVrDscto=CalcularDescuento  | NumeroEntero }} </strong> </td>
                </tr>
                <tr>
                  <td colspan="7"></td>
                  <td class="text-right">   <strong> Fletes </strong> </td>
                  <td class="text-right" style="width: 25px;">   <strong>
                    <input class="text-right"   v-model="PedVrFletes" style="width: 80px;"> </strong> </td>
                  </tr>
                  <tr>
                    <td colspan="7"></td>
                    <td class="text-right">   <strong> Iva </strong> </td>
                    <td class="text-right">   <strong> {{ PedVrIva=CalcularIva  | NumeroEntero }}  </strong> </td>
                  </tr>
                  <tr>
                    <td colspan="7"></td>
                    <td class="text-right">   <strong> Total Pedido </strong> </td>
                    <td class="text-right">   <strong> {{ PedVrTotPed=CalcularTotalPedido  | NumeroEntero }} </strong> </td>
                  </tr>
                </table>


              </div>
              <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                      texto
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
            </div>
            <hr/>
         </div>
  </div>

</div>
</div>
</div>

</div>


</div>

</template>
<script>

import Datepicker     from 'vuejs-datepicker';
import { es}          from 'vuejs-datepicker/dist/locale'
//import Formato        from '../mixins/FormatoNum';

var moment = require('moment');
moment.locale('es');

  export default {

      data(){
          return {
              ClientesArray : [],
              Compras       : [],
              NotasVentas   : [],
              NotasCartera  : [],
              Contactos     : [],
              NuevoPedido   : [],
              id_terc       : 0,
              nom_vend_ppal :'',
              fcha_dspcho   : '',
              es            : es,
              PedVrSubtotal   : 0,
              PedPcjeDscto    : 0.00,
              PedVrDscto      : 0.0,
              PedVrFletes     : 0.0,
              PedPcjeIva      : 0.00,
              PedVrIva        : 0.0,
              PedVrTotPed     : 0.0,
          }
      },
     // mixins: [ Formato ],

      components: {
        Datepicker
      },

      computed:{
        CalcularSubTotal() {
            var SubTotal = 0;
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
          AsignarIdTercero( IdClienteSelecionado ){
              this.NuevoPedido = [];
              this.id_terc     = IdClienteSelecionado;
              this.BuscarVendedores();
              this.BuscarCompras();
              this.BuscarNotasVenta();
              this.BuscarNotasCartera();
              this.BuscarContactos();
          },
          BuscarVendedores(){
              let Me  = this;
              let Url = '/clientes/vendedores/'+ '?id_terc='+this.id_terc;
              axios.get( Url )
                .then( response => {
                    Me.nom_vend_ppal = response.data[0].nom_vend_ppal
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
          AgregarProductoPedido( data ){
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
                  vr_dscto        : 0,
                  vr_unit_real    : 0,
              };
              this.NuevoPedido.push( newItem );
          },
          GrabarPedido(){
            let Me = this;
            let Url = '/terceros/pedido/grabar';
            axios.post( Url,
              {'id_terc' : Me.id_terc, 'pedido': this.NuevoPedido  })
              .then( response => {
                  console.log('ok');
                  console.log( response.data);
              })
              .catch(this.ErrorOnFail );
          },

          FormatoFechaPicker(date) {
              return moment(date).format('DD-MMMM-YYYY');
          },

    },// Methods


  };

</script>


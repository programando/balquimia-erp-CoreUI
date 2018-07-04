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
                <a class="nav-link"  data-toggle="tab" href="#profile" role="tab"  aria-selected="false">Pedido Generado</a>
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
              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        texto
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

import Datepicker from 'vuejs-datepicker';
import { es}      from 'vuejs-datepicker/dist/locale'
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
          }
      },
      components: {
        Datepicker
      },

      methods: {
          AsignarIdTercero( IdClienteSelecionado ){
              this.id_terc = IdClienteSelecionado;
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
              this.NuevoPedido= data.id_prd;
             console.log(data.id_prd );
          },

        FormatoFechaPicker(date) {
            return moment(date).format('DD-MMMM-YYYY');
        },
    },// Methods
  };

</script>

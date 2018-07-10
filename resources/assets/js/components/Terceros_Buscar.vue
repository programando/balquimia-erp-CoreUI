<template>
   <div>
        <div class="modal fade" data-backdrop="static" data-keyboard="false" :class="{'Modal-Show' : ModalClie}"
               tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
               <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" >Búsqueda de Clientes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="ModalClose()">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                   <div class="row">
                     <div class="col-sm-12">
                      <label>Buscar por...</label>
                      <div class="input-group">
                        <select class="form-control col-md-3" v-model='BuscarCliPor'>
                          <option value="nom_sys">NOMBRE/RAZÓN SOCIAL</option>
                          <option value="nro_identif">NIT</option>
                          <option value="nom_suc">SUCURSAL</option>
                          <option value="nom_ccial">NOMBRE COMERCIAL</option>
                        </select>
                        <input v-model        ='TextoBsqda'
                        class          ="form-control col-md-9"
                        placeholder    ="Digite datos para filtrar la lista"
                        style          ="width: 85%;"
                        @change="BuscarCliente()"
                        @input="BuscarCliente()"
                        autofocus = "autofocus">
                      </div>
                      <br>
                      <table class="table table-responsive-sm table-bordered table-striped table-sm" v-if="ClientesEncontrados.length">
                        <thead>
                          <tr>
                            <th> Nit</th>
                            <th> Nombre/Razón Soc.</th>
                            <th> Sucursal</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="Cliente in ClientesEncontrados" :key="Cliente.id_terc">
                            <td v-text="Cliente.nro_identif"></td>
                            <td v-text="Cliente.nom_sys"></td>
                            <td v-text="Cliente.nom_suc"> </td>
                            <td class="text-center">
                             <button type="button" class="btn btn-success btn-sm"  title="Seleccionar cliente" @click="AsignarIdTercero(Cliente)"><i class="fa  fa-check" ></i>
                             </button>
                           </td>
                         </tr>
                       </tbody>
                     </table>
                   </div>
                 </div>
               </div>
             </div> <!-- /.modal-content -->
           </div>   <!-- /.modal-dialog -->
          </div>     <!-- /.modal -->
    </div>
</template>

<script>
import Modals          from '../mixins/Modals';
import FormValidation  from '../mixins/FormValidation';
  export default{
      props :[ 'ModalClie'],

      data(){
          return {
              ClientesEncontrados :[],
              BuscarCliPor :'',
              TextoBsqda :'',
          }
      },
      mixins: [  Modals, FormValidation ],

      methods:{
         BuscarCliente(){
            let Me = this;
            let Url  = '/clientes/buscar/' + '?filtro='+Me.TextoBsqda;
            axios.get(Url)
            .then( response=>{
               this.ClientesEncontrados = response.data;
            })
            .catch( this.ErrorOnFail);
          },
        AsignarIdTercero( Tercero ){
            this.$emit('AsignarIdTercero', Tercero);
            this.TextoBsqda          ='',
            this.ClientesEncontrados =[];
        },
        ModalClose(){
          this.ModalClie=0;
        },
        ClearFields (){

        },
      }

  };
</script>

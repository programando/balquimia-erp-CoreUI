<template>

  <div class="container">

    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card">
          <div class="card-header"> <i class="fa fa-align-justify"></i> Líneas de Producto
            <button type="button" class="btn btn-sm btn-primary pull-right"   @click="ModalOpen('Nuevo')"> Crear Nuevo Registro</button>
          </div>
          <div class="card-body">
            <table class="table table-responsive-sm">
              <thead>
                <tr>
                  <th>Código</th>
                  <th>Nombre/Descripción</th>
                  <th>Estado</th>
                  <th>Sub-Líenas</th>
                  <th>Editar/Eliminar</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="Registro in DatosTabla" :key="Registro.id_linea">
                  <td v-text="Registro.cod_linea"></td>
                  <td v-text="Registro.nom_linea"></td>
                  <td>
                    <span v-if="Registro.inactivo" class="badge badge-danger">Inactiva</span>
                  </td>
                  <td>
                    <sublineas :Registro="Registro"></sublineas>
                  </td>
                  <td class="text-center">
                    <button type="button" class="btn btn-success btn-sm"  @click="ModalOpen('Editar', Registro)"  title="Editar registro">
                      <i class="fa  fa-pencil" ></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm"  @click="BorrarShowModal(Registro)" title="Eliminar registro">
                      <i class="fa fa-trash-o" ></i>
                    </button> &nbsp;
                  </td>
                </tr>
              </tbody>
            </table>
          </div>



        </div>

      </div>
    </div>

    <!-- MODAL PARA GRABAR REGISTRO -->
        <div class="modal fade" data-backdrop="static" data-keyboard="false" :class="{'Modal-Show' : ModalShow}"
                  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-primary" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" v-text="ModalTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="ModalClose()">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form  class="form-horizontal" method="post" enctype="multipart/form-data" @keydown="ErrorsClear($event.target.name)">
                  <div class="form-group row">

                    <label class="col-md-3 col-form-label">Código :</label>
                    <div class="col-md-9">
                      <input type="text"   :class = "{ 'is-invalid': ErrorHas('cod_linea')}" :disabled= "ModalShowEdit==1"
                             class="form-control"
                             style="width: 60px;"
                             v-model   = "form.cod_linea" >
                        <div class="help-block" style="color: red;" v-if="ErrorHas('cod_linea')">
                          <i class="fa  fa-hand-o-right" ></i>
                          <label class="" v-text="ErrorGet('cod_linea')"> </label>
                        </div>
                    </div>

                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 col-form-label">Línea :</label>
                    <div class="col-md-9">
                      <input type="text"   :class = "{ 'is-invalid': ErrorHas('nom_linea')}"
                             class="form-control"
                             v-model   = "form.nom_linea" >
                        <div class="help-block" style="color: red;" v-if="ErrorHas('nom_linea')">
                          <i class="fa  fa-hand-o-right" ></i>
                          <label class="" v-text="ErrorGet('nom_linea')"> </label>
                        </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-12">
                    <div class="input-group mb-4" v-if="ModalShowEdit">
                      <label class="container-chk"value="" >
                        <span  v-if="!form.inactivo"> Registro Activo</span>
                        <span  v-else="form.inactivo"> Registro Inactivo</span>
                        <input type="checkbox" v-model="form.inactivo" :checked="form.inactivo">
                        <span class="checkmark"></span>
                      </label>
                    </div>
                    </div>
                  </div>

                  <div class="form-group row">
                      <label class="col-md-3 col-form-label">Sub-Lineas:</label>
                      <div class="col-sm-9">
                          <select2 :options="DatosSubLineas" @SubLineasSeleccionas="SubLineasSeleccionadas"></select2>
                      </div>
                  </div>
                      <input type="hidden" v-model="form.id_linea"   >
                </form>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="ModalClose()">Cerrar</button>
                <button type="button" class="btn btn-primary" @click="Grabar()" v-if="!ModalShowEdit" :disabled="AnyError()">Grabar registro</button>
                <button type="button" class="btn btn-primary" @click="Actualizar()" v-else :disabled="AnyError()" >Actualizar registro</button>
              </div>
            </div> <!-- /.modal-content -->
          </div>   <!-- /.modal-dialog -->
        </div>     <!-- /.modal -->


       <!-- MODAL PARA BORRAR REGISTRO -->
        <div class="modal fade"  tabindex="-1" role="dialog" :class="{'Modal-Show-Delete':ModalShowDelete}">
          <div class="modal-dialog modal-danger" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Eliminar registro ?</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="ModalClose()">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <p>Confirma que desea borrar el registro : <br>
                  &nbsp;&nbsp;&nbsp;<strong v-text="form.nom_linea"> </strong>&nbsp; ?</p>
                <input type="hidden" v-model="form.id_linea">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" @click="ModalClose()">Cerrar</button>
                <button type="button" class="btn btn-danger"    @click="Borrar()">Eliminar registro</button>
              </div>
            </div> <!-- /.modal-content -->
          </div>   <!-- /.modal-dialog -->
        </div>     <!-- Fin del modal Eliminar -->



  </div>

</template>
<!--
          <select name="city" id="city" class="form-control" v-model="city" >
            <option v-for="item in items"
                    value="@{{item.list}}"
                    :selected="item.list=={{json_encode($ads->city)}}?true : false">
                @{{item.list}}
            </option>
        </select>
      -->

<script>

    import FormValidation from '../../mixins/FormValidation';
    import Modals         from '../../mixins/Modals';

    export default {
        mounted() {
            this.Listar();
            this.SublineasConsulta();
        },

        data() {
            return {
                 DatosTabla        : [],
                 DatosSubLineas    : [],
                 ErrorsController  : {},
                 Pagination        : {},
                 cod_linea     :'',
                 nom_linea : '',
                 form : {
                      cod_linea : '',
                      nom_linea : '',
                      orden     : '',
                      inactivo  : '',
                      sublineas : [],
                 },
              }
       },

       mixins: [ FormValidation, Modals ],

       methods: {
          Listar(){
            let Me = this
            axios.get(`/lineas?page=${this.$route.query.page || 1}`)
            .then( response =>{
               Me.DatosTabla =  response.data.data ;
               Me.Pagination = response.data;
               delete Me.Pagination.data;
            })
            .catch ( this.ErrorOnFail ) ;
          },

          SublineasConsulta(){
              let Me = this;
              axios.get('/sublineas-show')
                .then( response =>{
                   Me.DatosSubLineas =  response.data;
                })
                .catch ( this.ErrorOnFail ) ;
          },

          SubLineasSeleccionadas( Seleccionadas ){
              this.form.sublineas = Seleccionadas;
          },

          Grabar(){
                let Me = this;
                axios.post('/lineas', Me.form ).then( response => {
                    Me.ModalClose();
                    Me.Listar();
                    toastr.success( "Registro grabado con éxito !!!");
                })
                .catch( this.ErrorOnFail );
            },

            Actualizar(){
                let Me   = this;
                let URL  = '/lineas/'+Me.id_linea;
                axios.put( URL, Me.form
                ).then(  response => {
                    Me.ModalClose();
                    Me.Listar();
                    toastr.success( 'Registro actualizado con éxito !!!!' );
                }).catch( this.ErrorOnFail );
            },
          Borrar(){
                let Me = this;
                var url = '/lineas'   + '/'+this.form.id_linea;
                axios.delete(url).then(response => {
                  Me.ModalClose();
                  Me.Listar();
                  toastr.success( "Registro borrado con éxito !!!!");
                }).catch( error => {
                    toastr.error( "El registro no pudo ser eliminado porque causaría inconsistencias en su base de datos.");
                  });
             },

          ClearFields(){
              this.form           = {};
              this.form.sublineas = [];
          },

          DataFields( data ){
            this.form.cod_linea  = data.cod_linea;
            this.form.nom_linea  = data.nom_linea;
            this.form.id_linea   = data.id_linea;
            this.form.inactivo   = data.inactivo;
          },
       },  // Methods

    };
</script>


<style src="vue-multiselect/dist/vue-multiselect.min.css">


</style>

<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card">
          <div class="card-header"> <i class="fa fa-align-justify"></i> Sub-Líneas
            <button type="button" class="btn btn-sm btn-primary pull-right"   @click="ModalOpen('Nuevo')"> Crear Nuevo Registro</button>
          </div>
          <div class="card-body">
            <table class="table table-responsive-sm">
              <thead>
                <tr>
                  <th>Descripción</th>
                  <th>Estado</th>
                  <th>Editar/Eliminar</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="Registro in DatosTabla" :key="Registro.id_sub_linea">
                  <td v-text="Registro.nom_sub_linea"></td>
                  <td>
                    <span v-if="Registro.inactivo" class="badge badge-danger">Inactivo</span>
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

          <pagination-links :Pagination="Pagination"> </pagination-links>

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
                <form action="" method="post" enctype="multipart/form-data" @keydown="ErrorsClear($event.target.name)">
                    <label>Nombre/Descripción de la sublinea :</label>
                      <input type="text" class="form-control" :class = "{ 'is-invalid': ErrorHas('nom_sub_linea')}"
                              autofocus = "autofocus"
                              name      = 'nom_sub_linea'
                              placeholder="Descripción de la sublinea"
                              v-model   = "nom_sub_linea" >
                        <div style="color: red;" v-if="ErrorHas('nom_sub_linea')">
                          <i class="fa  fa-hand-o-right" ></i>
                          <label class="" v-text="ErrorGet('nom_sub_linea')"> </label>
                        </div>
                 <br>
                    <div class="input-group mb-4" v-if="ModalShowEdit">
                      <label class="container-chk"value="" id="inactivo" >
                        <span  v-if="!inactivo"> Registro Activo</span>
                        <span  v-else="inactivo"> Registro Inactivo</span>
                        <input type="checkbox" v-model="inactivo" :checked="inactivo" name="inactivo">
                        <span class="checkmark"></span>
                      </label>
                    </div>
                      <input type="hidden" v-model="id_sub_linea">
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="ModalClose()">Cerrar</button>
                <button type="button" class="btn btn-primary" @click="Grabar()" v-if="!ModalShowEdit" :disabled="AnyError()">Grabar registro</button>
                <button type="button" class="btn btn-primary" @click="Actualizar()" :disabled="AnyError()" v-else>Actualizar registro</button>
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
                  &nbsp;&nbsp;&nbsp;<strong v-text="nom_sub_linea"> </strong>&nbsp; ?</p>
                <input type="hidden" v-model="id_sub_linea">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" @click="ModalClose()">Cerrar</button>
                <button type="button" class="btn btn-danger"    @click="Borrar()">Eliminar registro</button>
              </div>
            </div> <!-- /.modal-content -->
          </div>   <!-- /.modal-dialog -->
        </div>     <!-- Fin del modal Eliminar -->
  </div> <!-- /container !-->

</template>


<script>
    import FormValidation from '../../mixins/FormValidation';
    import Modals         from '../../mixins/Modals';
    export default {
        mounted() {
            this.Listar();
           },
        data() {
            return {
                 DatosTabla        : [],
                 ErrorsController  : {},
                 Pagination        : {},
                 id_sub_linea          : 0,
                 nom_sub_linea         : '',
                 inactivo          : 0,
              }
       },

       mixins: [ FormValidation, Modals ],

       methods: {
          Listar(){
            let Me = this
            axios.get(`/sublineas?page=${this.$route.query.page || 1}`)
            .then( response =>{
               Me.DatosTabla =  response.data.data ;
               Me.Pagination = response.data;
               delete Me.Pagination.data;
            })
            .catch ( this.ErrorOnFail ) ;
          },

          Grabar(){
                let Me = this;
                axios.post('/sublineas',{'nom_sub_linea' : Me.nom_sub_linea
                }).then( response => {
                    Me.ModalClose();
                    Me.Listar();
                    toastr.success( "Registro grabado con éxito !!!");
                })
                .catch(this.ErrorOnFail );
            },
            Actualizar(){
                let Me   = this;
                let URL  = '/sublineas/'+Me.id_sub_linea;
                axios.put( URL,{'nom_sub_linea' : Me.nom_sub_linea, 'id_sub_linea' : Me.id_sub_linea, 'inactivo' : Me.inactivo
                }).then(  response => {
                    Me.ModalClose();
                    Me.Listar();
                    toastr.success( 'Registro actualizado con éxito !!!!' );
                }).catch( this.ErrorOnFail );
            },
          Borrar(){
                let Me = this;
                var url = '/sublineas'   + '/'+this.id_sub_linea;
                axios.delete(url).then(response => {
                  Me.ModalClose();
                  Me.Listar();
                  toastr.success( "Registro borrado con éxito !!!!");
                }).catch( error => {
                    toastr.error( "El registro no pudo ser eliminado porque causaría inconsistencias en su base de datos.");
                  });
             },

          ClearFields(){
              this.nom_sub_linea  = '';
              this.id_sub_linea   = 0;
          },

          DataFields( data ){
            this.nom_sub_linea  = data.nom_sub_linea;
            this.id_sub_linea   = data.id_sub_linea;
            this.inactivo       = data.inactivo;
          },
       }, // Methods

    };
</script>



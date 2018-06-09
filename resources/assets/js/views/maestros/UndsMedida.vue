<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card">
          <div class="card-header"><i class="fa fa-align-justify"></i> Unidades de Medida
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
                <tr v-for="Registro in DatosTabla" :key="Registro.id_med">
                  <td v-text="Registro.nom_med"></td>
                  <td>
                    <span v-if="Registro.inactivo" class="badge badge-danger">Inactiva</span>
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
                <form action="" method="post" enctype="multipart/form-data" @keydown="ErrorsClear($event.target.name)">
                    <label>Nombre/Descripción del Cargo :</label>
                      <input type="text" class="form-control" :class = "{ 'is-invalid': ErrorHas('nom_med')}"
                              autofocus = "autofocus"
                              name      = 'nom_med'
                              placeholder="Descripción de cargo"
                              v-model   = "nom_med" >
                        <div style="color: red;" v-if="ErrorHas('nom_med')">
                          <i class="fa  fa-hand-o-right" ></i>
                          <label class="" v-text="ErrorGet('nom_med')"> </label>
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
                      <input type="hidden" v-model="id_med">
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
                  &nbsp;&nbsp;&nbsp;<strong v-text="nom_med"> </strong>&nbsp; ?</p>
                <input type="hidden" v-model="id_med">
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
                 id_med          : 0,
                 nom_med         : '',
                 inactivo          : 0,
              }
       },

       mixins: [ FormValidation, Modals ],

       methods: {
          Listar(){
            let Me = this
            axios.get(`/medidas?page=${this.$route.query.page || 1}`)
            .then( response =>{
               Me.DatosTabla =  response.data.data ;
               Me.Pagination = response.data;
               delete Me.Pagination.data;
            })
            .catch ( this.ErrorOnFail ) ;
          },

          Grabar(){
                let Me = this;
                axios.post('/medidas',{'nom_med' : Me.nom_med
                }).then( response => {
                    Me.ModalClose();
                    Me.Listar();
                    toastr.success( "Registro grabado con éxito !!!");
                })
                .catch(this.ErrorOnFail );
            },
            Actualizar(){
                let Me   = this;
                let URL  = '/medidas/'+Me.id_med;
                axios.put( URL,{'nom_med' : Me.nom_med, 'id_med' : Me.id_med, 'inactivo' : Me.inactivo
                }).then(  response => {
                    Me.ModalClose();
                    Me.Listar();
                    toastr.success( 'Registro actualizado con éxito !!!!' );
                }).catch( this.ErrorOnFail );
            },
          Borrar(){
                let Me = this;
                var url = '/medidas'   + '/'+this.id_med;
                axios.delete(url).then(response => {
                  Me.ModalClose();
                  Me.Listar();
                  toastr.success( "Registro borrado con éxito !!!!");
                }).catch( error => {
                    toastr.error( "El registro no pudo ser eliminado porque causaría inconsistencias en su base de datos.");
                  });
             },

          ClearFields(){
              this.nom_med  = '';
              this.id_med   = 0;
          },

          DataFields( data ){
            this.nom_med  = data.nom_med;
            this.id_med   = data.id_med;
            this.inactivo   = data.inactivo;
          },
       }, // Methods

    };
</script>



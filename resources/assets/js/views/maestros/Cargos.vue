<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card">
          <div class="card-header"> <i class="fa fa-align-justify"></i> Cargos
            <button type="button" class="btn btn-sm btn-primary pull-right"   @click="ModalOpen('Nuevo')"> Crear Nuevo Registro</button>
          </div>
          <div class="card-body">
            <button @click="BuscarCliente()"> Consulta</button>
            <table class="table table-responsive-sm">
              <thead>
                <tr>
                  <th>Descripción</th>
                  <th>Estado</th>
                  <th>Editar/Eliminar</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="Registro in DatosTabla" :key="Registro.id_cargo">
                  <td v-text="Registro.nom_cargo"></td>
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
                    <label>Nombre/Descripción del Cargo :</label>
                      <input type="text" class="form-control" :class = "{ 'is-invalid': ErrorHas('nom_cargo')}"
                              autofocus = "autofocus"
                              name      = 'nom_cargo'
                              placeholder="Descripción de cargo"
                              v-model   = "nom_cargo" >
                        <div style="color: red;" v-if="ErrorHas('nom_cargo')">
                          <i class="fa  fa-hand-o-right" ></i>
                          <label class="" v-text="ErrorGet('nom_cargo')"> </label>
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
                      <input type="hidden" v-model="id_cargo">
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
                  &nbsp;&nbsp;&nbsp;<strong v-text="nom_cargo"> </strong>&nbsp; ?</p>
                <input type="hidden" v-model="id_cargo">
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
                 id_cargo          : 0,
                 nom_cargo         : '',
                 inactivo          : 0,
              }
       },

       mixins: [ FormValidation, Modals ],

       methods: {
          Listar(){
            let Me = this
            axios.get(`/cargos?page=${this.$route.query.page || 1}`)
            .then( response =>{
               Me.DatosTabla =  response.data.data ;
               Me.Pagination = response.data;
               delete Me.Pagination.data;
            })
            .catch ( this.ErrorOnFail ) ;
          },
          BuscarCliente(){
              axios.get('/terceros/buscar')
              .then( response =>{
                  console.log( response.data )
              })
              .catch( error =>{
                 console.log( error );
              });
          },

          Grabar(){
                let Me = this;
                axios.post('/cargos',{'nom_cargo' : Me.nom_cargo
                }).then( response => {
                    Me.ModalClose();
                    Me.Listar();
                    toastr.success( "Registro grabado con éxito !!!");
                })
                .catch(this.ErrorOnFail );
            },
            Actualizar(){
                let Me   = this;
                let URL  = '/cargos/'+Me.id_cargo;
                axios.put( URL,{'nom_cargo' : Me.nom_cargo, 'id_cargo' : Me.id_cargo, 'inactivo' : Me.inactivo
                }).then(  response => {
                    Me.ModalClose();
                    Me.Listar();
                    toastr.success( 'Registro actualizado con éxito !!!!' );
                }).catch( this.ErrorOnFail );
            },
          Borrar(){
                let Me = this;
                var url = '/cargos'   + '/'+this.id_cargo;
                axios.delete(url).then(response => {
                  Me.ModalClose();
                  Me.Listar();
                  toastr.success( "Registro borrado con éxito !!!!");
                }).catch( error => {
                    toastr.error( "El registro no pudo ser eliminado porque causaría inconsistencias en su base de datos.");
                  });
             },

          ClearFields(){
              this.nom_cargo  = '';
              this.id_cargo   = 0;
          },

          DataFields( data ){
            this.nom_cargo  = data.nom_cargo;
            this.id_cargo   = data.id_cargo;
            this.inactivo   = data.inactivo;
          },
       }, // Methods

    };
</script>



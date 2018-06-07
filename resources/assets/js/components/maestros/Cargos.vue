<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card">
          <div class="card-header">
            <i class="fa fa-align-justify"></i> Cargos
            <button type="button" class="btn btn-sm btn-primary pull-right" data-toggle='modal' data-target='#primaryModal'   > Crear Nuevo Registro</button>



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
                <tr v-for="Registro in DatosTabla" :key="Registro.id_cargo">
                  <td v-text="Registro.nom_cargo"></td>
                  <td>
                    <span v-if="Registro.inactivo" class="badge badge-danger">Inactivo</span>
                  </td>
                  <td class="text-center">
                    <button type="button" class="btn btn-success btn-sm"   title="Editar registro">
                      <i class="fa  fa-pencil" ></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm"   title="Eliminar registro">
                      <i class="fa fa-trash-o" ></i>
                    </button> &nbsp;
                  </td>
                </tr>

              </tbody>
            </table>

          </div>
          <div class="card-footer">

          </div>
        </div>
      </div>
    </div>



        <div class="modal fade" data-backdrop="static" data-keyboard="false"
                id="primaryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-primary" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Crear Nuevo Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data" @keydown="clearErrors($event.target.name)">
                    <label>Nombre/Descripción del Cargo :</label>
                      <input type="text" class="form-control" :class = "{ 'is-invalid': hasError('nom_cargo')}"
                              autofocus = "autofocus"
                              name      = 'nom_cargo'
                              placeholder="Descripción de cargo"
                              v-model   = "nom_cargo" >

                        <div style="color: red;" v-if="hasError('nom_cargo')">
                          <i class="fa  fa-hand-o-right" ></i>
                          <label class="v-text="getError('nom_cargo')"   "> </label>
                        </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Grabar regsitro</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

  </div> <!-- /container !-->
</template>




<script>



    export default {

        mounted() {
            this.listarRegistros();
           },


        data() {
            return {
                 DatosTabla         :[],
                 ErrorsController   : {},
                 id_cargo             : 0,
                 nom_cargo          :'',

              }
       },

       methods: {
          listarRegistros(){
            let Me = this
            axios.get('/cargos')
            .then( response =>{
               Me.DatosTabla =  response.data.Registros.data ;
            })
            .catch ( error => {
                  console.log( error );
            });
          },

          clearErrors ( field){
                delete this.ErrorsController[field] ;
            },

          hasError ( field  ) {
                return this.ErrorsController.hasOwnProperty( field );
          },
            getError(field ){
             if ( this.ErrorsController[field]){
              return this.ErrorsController[field][0];
            }
          },

       }, // Methods

       computed: {



       } // Computeds

    };
</script>




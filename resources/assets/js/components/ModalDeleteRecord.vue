 <template>
     <div>
       <!-- MODAL PARA BORRAR REGISTRO -->
        <div class="modal fade"  tabindex="-1" role="dialog" :class="{'Modal-Show-Delete':VerModal}">
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
                  &nbsp;&nbsp;&nbsp;<strong v-text="DescripRegistro"> </strong>&nbsp; ?</p>
                <input type="hidden" v-model="IdRegistro">
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

<script >
import Modals         from '../mixins/Modals';
  export default {
      props : ['DescripRegistro', 'IdRegistro', 'MostrarModal'],
      mixins: [  Modals ],
      data(){
          return {
                VerModal : this.MostrarModal,
          }
      },
      methods: {
           ModalClose(){
              this.ModalShow       = 0;
              this.ModalShowDelete = 0;
              this.ModalShowEdit   = 0;
              this.VerModal        = 0;
              this.ClearFields();
          },
          ClearFields(){},
      }
  };
</script>

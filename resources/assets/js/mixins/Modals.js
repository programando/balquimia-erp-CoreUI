module.exports = {
   data() {
          return {
               ModalShow         : 0,
               ModalShowDelete   : 0,
               ModalShowEdit     : 0,
               ModalTitle        : '',
            }
     },
  methods:{
          ModalOpen( QueHacer='', data=[]){
              this.ErrorclearAll();
              this.ModalShow  = 1;
              this.ModalTitle = '';
              if ( QueHacer=='Nuevo' ){
                  this.ClearFields();
                  this.ModalTitle    = 'Nuevo Registro';
              }
             if ( QueHacer=='Editar' ){
                  this.ClearFields();
                  this.DataFields( data );
                  this.ModalTitle    = 'Modificar Registro';
                  this.ModalShowEdit = 1;
              }
          },
          ModalClose(){
              this.ModalShow       = 0;
              this.ModalShowDelete = 0;
              this.ModalShowEdit   = 0;
              this.ClearFields();
          },
          BorrarShowModal( data=[] ){
              this.DataFields ( data ) ;
              this.ModalShowDelete = 1;
          },
  }
};

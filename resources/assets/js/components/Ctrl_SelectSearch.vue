<template>
      <div>
          <vSelect
            :on-search  ="Buscar"
            :onChange   ="AsignarIdTercero"
            :options    = 'Datos'
            label       ="nom_terc"
            placeholder = 'buscar registros....'
          >
            <span slot="no-options"></span>
          </vSelect>
      </div>
</template>

<script>
        import vSelect   from 'vue-select';
         export default {
                props :['UrlSearch'],
          data(){
            return {
                Datos : [],
                id_terc       : 0,
            }
          },
         components:{
                  vSelect
              },
          methods: {
              Buscar( search, loading ){
                  let Me = this;
                  let Url  = Me.UrlSearch + '?filtro='+search;
                  axios.get( Url )
                    .then( response =>{
                      Me.Datos = response.data;
                    })
                    .catch ( this.ErrorOnFail ) ;
              },
              AsignarIdTercero( val1 ){
                  this.$emit('AsignarIdTercero', val1.id_terc);
              }
          }
         };
</script>


<template>
   <div>
       <div v-for="(item, key, index) in Registro.sub_lineas" :key="Registro.idlinea" style="display: inline;">
        <small @click="SubLineaBorrar(item.id_sub_linea, Registro.id_linea)">
        <a href="#">{{ item.nom_sub_linea }}</a>
        </small><span v-if="key < Registro.sub_lineas.length-1">,&nbsp;</span>
    </div>
    </div>
</template>

<script>

  export default{
      props :['Registro'],

      methods: {
              SubLineaBorrar( IdSubLinea, IdLinea ){
                   let UrlDel = "/sublineas-destroy/" + IdSubLinea  + "/" +  IdLinea;
                  axios.delete( UrlDel )
                   .then( response =>{
                      toastr.success( "Sub-Linea borrada con éxito !!!");
                      this.$router.push('/lineas');
                      this.$router.go('/lineas');
            })
            .catch (  error => {

            }) ;
          },
      }
  };
</script>

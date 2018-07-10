<template>
   <div>
    <div v-if="Contactos.length">
        <table class="table table-responsive-sm table-bordered table-striped table-sm">
          <thead>
              <tr>
                <th> </th>
                <th> Nombre Contacto</th>
                <th> Área Empresa</th>
                <th> Email</th>
                <th> Nro.Teléfono</th>
              </tr>
          </thead>
          <tbody>
            <tr v-for="Contacto in Contactos"  :key="Contacto.id_contacto">
               <td v-text="Contacto.nom_titulo"> </td>
               <td v-text="Contacto.nom_contacto"> </td>
               <td v-text="Contacto.nom_area_empsa"> </td>
               <td v-text="Contacto.email"> </td>
               <td v-text="Contacto.nro_tel"> </td>
            </tr>
          </tbody>
      </table>
    </div>
    <div class="col-sm-12 text-center" v-else>
       <br><br>
       <h4>No se han registrado contactos en la ficha del cliente </h4><br><br>
    </div>

    </div>
</template>

<script>

  export default{
      props :['Contactos'],

  };
</script>

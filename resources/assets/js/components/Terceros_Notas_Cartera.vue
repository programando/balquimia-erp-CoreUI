<template>
   <div>
      <div v-if="NotasCartera.length">
        <table class="table table-responsive-sm table-bordered table-striped table-sm" v-if="NotasCartera.length > 0">
          <thead>
            <tr>
              <th>Fecha</th>
              <th>Observaciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="NotaCartera in NotasCartera" :key="NotaCartera.id_terc_nota">
                <td>{{ NotaCartera.fcha_nota | FormatoFecha }}</td>
                <td>{{ NotaCartera.cartera  }}</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="col-sm-12 text-center" v-else>
        <br><br>
        <h4>No se han registrado observaciones de cartera</h4><br><br>
      </div>

    </div>
</template>

<script>

  export default{
      props :['NotasCartera'],


  };
</script>

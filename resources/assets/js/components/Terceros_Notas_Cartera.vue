<template>
   <div>
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
</template>

<script>

  export default{
      props :['NotasCartera'],


  };
</script>

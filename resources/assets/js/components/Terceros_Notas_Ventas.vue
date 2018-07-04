<template>
   <div>

      <table class="table table-responsive-sm table-bordered table-striped table-sm">
          <thead>
          <tr>
          <th>Fecha</th>
          <th>Observaciones</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="NotaVenta in NotasVentas" :key="NotaVenta.id_terc_nota">
            <td>{{ NotaVenta.fcha_nota | FormatoFecha }}</td>
            <td>{{ NotaVenta.ventas  }}</td>
          </tr>
          </tbody>
      </table>

    </div>
</template>

<script>

  export default{
      props :['NotasVentas'],


  };
</script>

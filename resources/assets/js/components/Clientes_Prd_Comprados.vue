<template>
   <div>
    <table class="table table-responsive-sm table-bordered table-striped table-sm">
      <thead>
          <tr>
            <th> Fecha</th>
            <th> Factura</th>
            <th> Producto</th>
            <th> Present.</th>
            <th> Cant</th>
            <th> $ Base</th>
            <th> Flete</th>
            <th> Financ.</th>
            <th> Mayor Vr.</th>
            <th> Dscto</th>
            <th> Vr.Unit.</th>
            <th> </th>
          </tr>
      </thead>
      <tbody>
        <tr v-for="Compra in Compras"  :key="Compra.id_fact_dt">
          <td> {{ Compra.fcha_fact | FormatoFecha }} </td>
          <td> {{ Compra.num_fact   }} </td>
           <td v-text="Compra.nom_prd"> </td>
           <td> {{ Compra.descrip  }} </td>
           <td class="text-right"> {{ Compra.cant            | NumeroEntero  }} </td>
           <td class="text-right"> {{ Compra.vr_precio_lista | NumeroEntero  }} </td>
           <td class="text-right"> {{ Compra.vr_flete        | NumeroEntero  }} </td>
           <td class="text-right"> {{ Compra.vr_fnacion      | NumeroEntero  }} </td>
           <td class="text-right"> {{ Compra.vr_precio_adic  | NumeroEntero  }} </td>
           <td class="text-right"> {{ Compra.vr_dscto        | NumeroEntero  }} </td>
           <td class="text-right"> {{ Compra.vr_unit_real    | NumeroEntero  }} </td>
           <td>
              <button type="button" class="btn btn-success btn-sm" @click="AgregarProductoPedido( Compra )"
                title="Agregar producto al pedido">
                 <i class="fa  fa-shopping-basket" ></i>
              </button>
            </td>
        </tr>
      </tbody>

</table>

    </div>
</template>

<script>

  export default{
      props :['Compras'],
      methods: {
          AgregarProductoPedido( data ) {
              this.$emit('AgregarProductoPedido', data);
      },

      }, //Methods
  };
</script>




<template>
<div>
  <multiselect
              :clear-on-select ="false"
              :close-on-select ="false"
              :multiple        ="true"
              :options         ="options"
              :preselect-first ="false"
              :preserve-search ="true"
              label            ="nom_sub_linea"
              track-by         ="nom_sub_linea"
              v-model          = 'itemsSelected'
              @select          ="ItemsSeleccionados"
              @remove          ="ItemsSeleccionados"
              selectLabel      ="Presione enter para seleccionar"
              deselectLabel    = "Presione enter para borrar"
              placeholder      = 'Seleccione'
          >
  </multiselect>
</div>
</template>

<script>
  import Multiselect from 'vue-multiselect';

  export default {
    props     : ['options'],
    components: { Multiselect },

    data(){
      return {
          itemsSelected : []
      }
    },
    methods: {
      ItemsSeleccionados() {
       setTimeout(() => {
          this.$emit('SubLineasSeleccionas', {
            data: this.itemsSelected
          });
        }, 300)

      }
    }
  };


</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

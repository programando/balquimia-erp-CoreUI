

 require('./bootstrap');
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
var moment = require('moment');
moment.locale('es');

var numeral = require('numeral');

import Vue       from 'vue';
import router    from './routes';
export const EventBus = new Vue();

Vue.component('pagination-links'                ,require( './components/PaginationLinks' ));
Vue.component('sublineas'                       ,require( './components/LineasSubLineas' ));
Vue.component('select2'                         ,require( './components/Ctrl_SelectMultiple' ));
Vue.component('selectsearch'                    ,require( './components/Ctrl_SelectSearch' ));
Vue.component('clientesprdcomprados'            ,require( './components/Clientes_Prd_Comprados' ));
Vue.component('terceroscontactos'               ,require( './components/Terceros_Contactos' ));
Vue.component('tercerosnotascartera'            ,require( './components/Terceros_Notas_Cartera' ));
Vue.component('tercerosnotasventas'            ,require( './components/Terceros_Notas_Ventas.vue' ));

Vue.filter('FormatoFecha', (value) => {  return moment(value).format('DD-MMM-YYYY');     });
Vue.filter('NumeroEntero', (value) => {  return numeral(value).format('0,0');             });

const VueApp = new Vue({
    el: '#VueApp',
    router,

});


//https://vue-multiselect.js.org/#sub-select-with-search
//https://github.com/asika32764/vue2-animate
//require('vue2-animate/dist/vue2-animate.min.css')
// https://github.com/euvl/vue-js-popover
//https://github.com/vuejs/awesome-vue

/* Librerias JS
         http://numeraljs.com/
         https://momentjs.com/
    DatePicker
         https://github.com/charliekassel/vuejs-datepicker#date-formatting
  */





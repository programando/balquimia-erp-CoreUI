

 require('./bootstrap');
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue       from 'vue';
import router    from './routes';


Vue.component('pagination-links'        ,require( './components/PaginationLinks' ));
Vue.component('sublineas'               ,require( './components/LineasSubLineas' ));
Vue.component('select2'                 ,require( './components/Ctrl_SelectMultiple' ));
Vue.component('selectsearch'            ,require( './components/Ctrl_SelectSearch' ));

const VueApp = new Vue({

    el: '#VueApp',
    router

});



//https://github.com/asika32764/vue2-animate
//require('vue2-animate/dist/vue2-animate.min.css')

/* Librerias JS
         http://numeraljs.com/
         https://momentjs.com/
  */





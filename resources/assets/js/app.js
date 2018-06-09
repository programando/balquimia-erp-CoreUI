

 require('./bootstrap');
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue       from 'vue';
import router    from './routes';

Vue.component('pagination-links', require( './components/PaginationLinks' ));


const VueApp = new Vue({

    el: '#VueApp',
    router

});



//https://github.com/asika32764/vue2-animate
//require('vue2-animate/dist/vue2-animate.min.css')




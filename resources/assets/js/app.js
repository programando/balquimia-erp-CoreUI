require('./bootstrap');
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue       from 'vue';
Vue.config.devtools = true;

Vue.component('ejemplo', require('./components/ExampleComponent'));
Vue.component('ejemplo2', require('./components/otro'));

const VueApp = new Vue({
    el: '#VueApp',
    data : {
        IdMenu : 0,
      }
});

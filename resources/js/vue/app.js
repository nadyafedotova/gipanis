
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue';
import './plugins/bootstrap';
import store from './store/store';
import App from './App.vue';

console.log('App', App);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
var elementExists = document.getElementById("vue-app");
if(elementExists !== null){
    const app = new Vue({
        el: '#vue-app',
        components: { App },
        store
    });
}




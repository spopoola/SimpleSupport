import router from './router'

/**
 * Load all of this project's JavaScript dependencies which
 * includes Vue and other libraries.
 */

require('./bootstrap');


Vue.component('app', require('./components/App.vue'));

const app = new Vue({
    router: router,

    el: '#app',
});

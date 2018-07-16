require('./bootstrap');

window.Vue = require('vue');
window.events = new Vue();

// Add Vue components
Vue.component('flash', require('./components/Flash/Flash.vue'));

const app = new Vue({
    el: '#app'
});

const tag = require('./components/tag');

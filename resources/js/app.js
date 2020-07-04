require('./bootstrap');

window.Vue = require('vue');

import router from './routes';
require('vue2-animate/dist/vue2-animate.min.css')

Vue.component('contact', require('./components/Contact').default);
// Vue.component('home', require('./views/Home').default);
// Vue.component('products', require('./views/Products').default);
// Vue.component('pedidos', require('./views/Pedidos').default);


const app = new Vue({
    el: '#app',
    router
});

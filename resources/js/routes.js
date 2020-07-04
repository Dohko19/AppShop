import Vue from 'vue';

import Router from 'vue-router';

Vue.use(Router);


export default new Router({
    routes: [
        {
            path: '/',
            name: 'home',
            component: require('./views/Home').default
        },
        {
            path: '/categories',
            name: 'gestionCategorias',
            component: require('./views/Categories').default
        },
        {
            path: '/productos',
            name: 'products',
            component: require('./views/Products').default
        },
        {
            path: '/pedidos',
            name: 'pedidos',
            component: require('./views/Pedidos').default
        },
        {
            path: '/category/:id',
            name: 'category_show',
            component: require('./views/CategoryShow').default
        },
        {
            path: '/products/:id',
            name: 'products_show',
            component: require('./views/ProductsShow').default
        },
        // Siempre encima de esta ruta
        {
            path: '*',
            component:  require('./views/404').default
        }
    ],
    linkExactActiveClass: 'active',
    mode: 'history',
    scrollBehavior (to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition
        } else {
            return { x: 0, y: 0 }
        }
    }
});


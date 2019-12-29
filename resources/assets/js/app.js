import Vue from 'vue'
import VueRouter from 'vue-router'


Vue.use(VueRouter)

import App from './views/App'
import Home from './views/Home'
import ChamadosAbertos from './views/chamados/ChamadosAbertos'
import ShowChamado from './views/chamados/ShowChamado'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/chamados',
            name: 'chamados-abertos',
            component: ChamadosAbertos
        },
        {
            path: '/chamados/:id',
            name: 'show-chamado',
            component: ShowChamado
        },
        // {
        //     // 404
        //     path: '*'
        // }
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
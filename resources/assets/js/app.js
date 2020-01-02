import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from './views/App'

import AbrirChamado from './views/chamados/AbrirChamado'
import ChamadosAbertos from './views/chamados/ChamadosAbertos'
import ShowChamado from './views/chamados/ShowChamado'

import ShowCliente from './views/clientes/ShowCliente'
import IndexClientes from './views/clientes/IndexClientes'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            redirect: '/chamados'
        },
        {
            path: '/chamados',
            name: 'chamados.abertos',
            component: ChamadosAbertos
        },
        {
            path: '/abrir',
            name: 'chamados.abrir',
            component: AbrirChamado
        },
        {
            path: '/chamados/:id',
            name: 'chamados.show',
            component: ShowChamado
        },
        {
            path: '/clientes',
            name: 'clientes.index',
            component: IndexClientes
        },
        {
            path: '/clientes/:id',
            name: 'clientes.show',
            component: ShowCliente
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
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from './views/App'

import AbrirChamado from './views/chamados/AbrirChamado'
import ChamadosAbertos from './views/chamados/ChamadosAbertos'
import ChamadosFechados from './views/chamados/ChamadosFechados'
import Itinerario from './views/chamados/Itinerario'
import ImportarExportar from './views/chamados/ImportarExportar'
import ResultadoBusca from './views/chamados/ResultadoBusca'
import ShowChamado from './views/chamados/ShowChamado'
import StatusCliente from './views/chamados/StatusCliente'

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
            path: '/itinerario',
            name: 'itinerario',
            component: Itinerario,
            meta: {
                title: "Itinerário"
            }
        },
        {
            path: '/resultadobusca',
            name: 'resultadobusca',
            component: ResultadoBusca,
            meta: {
                title: "Busca"
            }
        },
        {
            path: '/chamados',
            name: 'chamados.abertos',
            component: ChamadosAbertos,
            meta: {
                title: "Cham.Abertos"
            }
        },
        {
            path: '/fechados',
            name: 'chamados.fechados',
            component: ChamadosFechados,
            meta: {
                title: "Cham.Fechados"
            }
        },
        {
            path: '/abrir',
            name: 'chamados.abrir',
            component: AbrirChamado,
            meta: {
                title: "Abrir Chamado"
            }
        },
        {
            path: '/chamados/:id',
            name: 'chamados.show',
            component: ShowChamado,
            meta: {
                title: "Chamado"
            }
        },
        {
            path: '/clientes',
            name: 'clientes.index',
            component: IndexClientes,
            meta: {
                title: "Clientes"
            }
        },
        {
            path: '/clientes/:id',
            name: 'clientes.show',
            component: ShowCliente,
            meta: {
                title: "Cliente"
            }
        },
        {
            path: '/importarexportar',
            name: 'importarexportar',
            component: ImportarExportar,
            meta: {
                title: "Importar/Exportar"
            }
        },
        {
            path: '/statuscliente',
            name: 'statuscliente',
            component: StatusCliente,
            meta: {
                title: "Status de Chamados"
            }
        }

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
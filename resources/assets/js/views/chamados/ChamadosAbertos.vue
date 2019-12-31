<template>
    <div class="chamados-abertos-list row">
        <div
            v-if="loading"
            class="loading-wrapper">
            <div class="lds-facebook"><div></div><div></div><div></div></div>
        </div>
        <div v-if="!loading && !error && chamados.length < 1" class="empty-list">
            <h4>Sem chamados abertos</h4>    
        </div>
        <Chamado 
            v-for="chamado in chamados"
            v-bind:key="chamado.id"
            v-bind:chamado="chamado" />

        <div v-if="error" class="messages-bar">
            <div><b>Erro: </b></div>
            <div>{{error}}</div>
        </div>
    </div>
</template>

<script>
import Chamado from '../../components/chamados/Chamado';

const CHAMADOS_INDEX_API_URL = "/api/chamados?status=ABERTO";

let chamados = [],
    error = '';

export default {
    components: {
        Chamado
    },
    data() {
        return {
            chamados,
            error
        };
    },
    created () {
        this.fetchData()
    },
    watch: {
        '$route': 'fetchData'
    },
    methods: {
        fetchData () {
            this.error = null
            this.loading = true
            fetch(CHAMADOS_INDEX_API_URL)
                .then( resp => resp.json() )
                .then( data => {
                    this.setData(
                        data
                    )
                })
                .catch( error => {
                    this.loading = false
                    this.error = error
                })
        },
        setData(chamados) {
            this.chamados = chamados;
            this.loading = false
        }
    }
}
</script>

<style lang="scss">
    .chamados-abertos-list{
        padding-top: 6px;
        padding: 6px 2px 0 2px;
    }

     .messages-bar {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: red;
        height: 50px;
        color: white;
        text-align: center;
    }

    .empty-list {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .empty-list h4{
        color: #7d7d7d;
    }

    .loading-wrapper {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 10;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #3e3b3b94;


    }

   .loading-wrapper img {
        width: 60% !important;
        height: 30% !important;
    }

    .lds-facebook {
    display: inline-block;
    position: relative;
    width: 80px;
    height: 80px;
    }
    .lds-facebook div {
    display: inline-block;
    position: absolute;
    left: 8px;
    width: 16px;
    background: #fff;
    animation: lds-facebook 1.2s cubic-bezier(0, 0.5, 0.5, 1) infinite;
    }
    .lds-facebook div:nth-child(1) {
    left: 8px;
    animation-delay: -0.24s;
    }
    .lds-facebook div:nth-child(2) {
    left: 32px;
    animation-delay: -0.12s;
    }
    .lds-facebook div:nth-child(3) {
    left: 56px;
    animation-delay: 0;
    }
    @keyframes lds-facebook {
    0% {
        top: 8px;
        height: 64px;
    }
    50%, 100% {
        top: 24px;
        height: 32px;
    }
    }

</style>
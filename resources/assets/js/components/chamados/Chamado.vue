<template>
    <div class="chamado col s12">
        <h6>{{ chamado.descricao }}</h6>
        
        <div class="dt_ag_execucao">
            <p><b>Aberto em:</b> <span>{{ chamado.dt_abertura }}</span></p>
        </div>
        <div class="dt_ag_execucao">
            <p><b>Agendado para:</b> <span>{{ chamado.dt_ag_execucao || '--' }}</span></p>
        </div>
    
        <router-link :to="{ name: 'chamados.show', params: { id: chamado.id }}">
            <i class="material-icons details-arrow">arrow_forward</i>
        </router-link>

        <button 
            v-if="!chamado.isInclusoNoItinerario"
            @click="adicionarNoItinerario"
            class="btn-clickti-blue" href="#"
            >Add no Itinerário
        </button>
        <button 
            v-if="chamado.isInclusoNoItinerario"
            @click="removerDoItinerario"
            class="btn-clickti-blue btn-remover-do-itinerario" href="#"
            >Remover do Itinerário
        </button>
        <!--div class="data-abertura" style="display: inline-block">
            <p style="font-size: 0.7rem;">Aberto</p>
            <p style="font-size: 0.7rem;">{{ chamado.dt_abertura }}</p>
        </div-->
    </div>
</template>

<script>

const CHAMADOS_UPDATE_API_URL_PREFIX = "/api/chamados/";

export default {
    props: [ 
        'chamado',
    ],
    computed: {
        horaAbertura(){
            return this.chamado.dt_abertura;
        },
        dataAbertura(){

        }
    },
    methods: {
        adicionarNoItinerario(){
            this.$parent.$emit("changeloadingstatus", true);

            console.log("adicionarNoItinerario...", this.chamado);

            this.chamado.isInclusoNoItinerario = true;

            fetch(CHAMADOS_UPDATE_API_URL_PREFIX + this.chamado.id, {
                headers: {
                    "Content-Type": "application/json",
                Accept: "application/json, text-plain, */*",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": document
                                            .querySelector('meta[name="csrf-token"]')
                                            .getAttribute("content")
                },
                method: "put",
                credentials: "same-origin",
                body: JSON.stringify(this.chamado)
            })
                .then(resp => resp.json())
                .then(chamado => {
                    console.log("voltou", chamado);
                    this.setData(chamado);
                })
                .catch(error => {
                    this.$emit("changeloadingstatus", false);
                    this.error = error;
                });
            
            
        },
        removerDoItinerario(){
            this.$parent.$emit("changeloadingstatus", true);

            console.log("removerDoItinerario...", this.chamado);

            this.chamado.isInclusoNoItinerario = false;

            fetch(CHAMADOS_UPDATE_API_URL_PREFIX + this.chamado.id, {
                headers: {
                    "Content-Type": "application/json",
                Accept: "application/json, text-plain, */*",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": document
                                            .querySelector('meta[name="csrf-token"]')
                                            .getAttribute("content")
                },
                method: "put",
                credentials: "same-origin",
                body: JSON.stringify(this.chamado)
            })
                .then(resp => resp.json())
                .then(chamado => {
                    console.log("voltou", chamado);
                    this.setData(chamado);
                })
                .catch(error => {
                    this.$emit("changeloadingstatus", false);
                    this.error = error;
                });
            
            
        },
        setData(chamado) {
            this.chamado = chamado;
            this.$parent.$emit("changeloadingstatus", false);
        }
    },
}
</script>

<style>
.chamado {
    position: relative;
    border-radius: 10px;
    background: #eaeaea;
    padding: 6px !important;
    margin-bottom: 5px;
    box-shadow: 2px 2px 3px #cecece;
    min-height: 75px !important;
}

.observacao{
    max-width: 80%;
}

.data-abertura {
    position: absolute;
    bottom: 5px;
    right: 5px;
}

h6 {
    font-size: 1.5rem;
    margin-bottom: 3px;
    color: #095979;
    font-weight: bold;
}

p {
    color: #808080;
}

h6, p{
    margin: 0
}

.details-arrow {
    position: absolute;
    top: 8px;
    right: 20px;
}

.btn-clickti-blue {
    float: right;
    background: #053244;
    padding: 10px;
    color: white;
    font-weight: bold;
    cursor: pointer;
}

.btn-remover-do-itinerario{
    background: transparent !important;
    color: #545454;
    cursor: pointer;
}
</style>
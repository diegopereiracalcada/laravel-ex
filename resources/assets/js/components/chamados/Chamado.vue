<template>
    <div class="chamado col s12">
        <router-link :to="{ name: 'chamados.show', params: { id: chamado.id }}">
            <h6>{{ chamado.cliente_shortname || chamado.cliente.shortname }}</h6>
        
            <p>
                <b>{{ chamado.descricao }}</b>
            </p>
            <p v-if="mostrarDataAbertura != false">
                Aberto em: <span>{{ horaAbertura }}</span>
            </p>
            <p v-if="chamado.dt_ag_execucao">
                Agendado para: <span>{{ horaAgendamento }}</span>
            </p>
            <p v-if="mostrarDataFechamento">
                Fechado em: <span>{{ horaFechamento }}</span>
            </p>
            <p v-if="chamado.preventiva" 
                style="color: #095979; font-size: 1.2rem"
                ><b>Preventiva Inclusa</b>
            </p>
        
            <i class="material-icons details-arrow">arrow_forward</i>

            <!--div class="data-abertura" style="display: inline-block">
                <p style="font-size: 0.7rem;">Aberto</p>
                <p style="font-size: 0.7rem;">{{ chamado.dt_abertura }}</p>
            </div-->


        </router-link>
        <div v-if="habilitarAdicionarNoItinerario">
            <button 
                v-if="!chamado.isInclusoNoItinerario"
                @click="adicionarNoItinerario"
                class="btn-clickti-blue" 
                href="#"
                style="border:none"
                >Add no Itinerário
            </button>
            <button 
                v-if="chamado.isInclusoNoItinerario"
                @click="removerDoItinerario"
                class="btn-clickti-blue btn-remover-do-itinerario" 
                href="#"
                >Remover do Itinerário
            </button>
        </div>
        <div v-if="this.mostrarBotaoReabrir">
            <button 
                @click="reabrirChamado"
                class="btn-clickti-blue btn-reabrir-chamado" 
                href="#"
                >Reabrir
            </button>
        
        </div>
    </div>
</template>

<script>

const CHAMADOS_UPDATE_API_URL_PREFIX = "/api/chamados/";

function getFormattedDate(dt){
    console.log("dt", dt);
    var ano = dt.slice(0,4);
    var mes = dt.slice(5,7);
    var dia = dt.slice(8,10);
    var horas = dt.slice(11,13);
    var minutos = dt.slice(14,16);
    var segundos = dt.slice(17);

    var formatted = dia + "/" + mes + "/" + ano + " " + horas + ":" + minutos;
    //var formattedWithSeconds = dia + "/" + mes + "/" + ano + " " + horas + ":" + minutos + ":" + segundos;

    return formatted;
}

export default {
    props: [ 
        'chamado',
        'habilitarAdicionarNoItinerario',
        'mostrarDataAbertura',
        'mostrarDataFechamento',
        'mostrarBotaoReabrir'
    ],
    computed: {
        horaAgendamento(){
            return getFormattedDate(this.chamado.dt_ag_execucao);
        },
        
        horaAbertura(){
            return getFormattedDate(this.chamado.dt_abertura);
        },
        
        horaFechamento(){
            return getFormattedDate(this.chamado.dt_fechamento);
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
        reabrirChamado(){
            this.$parent.$emit("changeloadingstatus", true);

            console.log("reabrirChamado...", this.chamado);

            this.chamado.status = 'ABERTO';

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
                    this.setData(chamado);
                    alert("Chamado '" + chamado.descricao + "' reaberto");
                    this.$emit("refreshList", false);
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

.btn-clickti-blue,
.btn-clickti-blue:hover,
.btn-clickti-blue:focus,
.btn-clickti-blue:active {
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

.btn-remover-do-itinerario:focus,
.btn-remover-do-itinerario:hover,
.btn-remover-do-itinerario:active{
        color: #545454;

}
</style>
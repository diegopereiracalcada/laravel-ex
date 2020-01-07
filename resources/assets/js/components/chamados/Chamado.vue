<template>
    <router-link :to="{ name: 'chamados.show', params: { id: chamado.id }}">

        <div class="chamado col s12">
            
            <h6>{{ chamado.descricao }}</h6>
            
            <div class="observacao" style="display: inline-block">
                <p>{{ chamado.shortname }}</p>
            </div>
        
            <i class="material-icons details-arrow">arrow_forward</i>
            <div class="data-abertura" style="display: inline-block">
                <p style="font-size: 0.7rem;">Aberto</p>
                <p style="font-size: 0.7rem;">{{ chamado.dt_abertura }}</p>
            </div>
        </div>
    </router-link>
</template>

<script>
export default {
    props: [ 
        'chamado',
    ],
    computed: {
        horaAbertura(){
            return this.chamado.dt_abertura;
        },
        dataAbertura(){

        },
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

</style>
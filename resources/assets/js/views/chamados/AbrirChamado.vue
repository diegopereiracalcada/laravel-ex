<template>
    <FormChamado 
        :updateMode="false" 
        :mostrarIncluirNoItinerario="true" 
        ></FormChamado>
</template>

<script>
import FormChamado from '../../components/chamados/FormChamado.vue'

export default { 
    components: {
        FormChamado
    },
}
</script>

<style lang="scss">
    
</style>
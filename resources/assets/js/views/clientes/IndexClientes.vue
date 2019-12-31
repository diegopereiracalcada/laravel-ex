<template>
    <div>
        <IndexTable
            url="/api/clientes"
            showRouteName="clientes.show"
            :hasPagination=false
            v-bind:headers = "[
                {
                    label: 'Apelido',
                    field: 'shortname'
                },
                {
                    label: 'Nome',
                    field: 'name',
                    linkToShowPage: true
                },
                {
                    label: 'Cpf/Cnpj',
                    field: 'cpfcnpj'
                },
                {
                    label: 'Telefone',
                    field: 'telefone'
                },
            ]" />
    </div>
</template>

<script>
import IndexTable from '../../components/IndexTable';
export default {
    components: {
        IndexTable
    }
}
</script>

<style lang="scss">
    
</style>
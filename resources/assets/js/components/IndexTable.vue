<template>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th v-for="header in headers">
                        {{header.label}}
                    </th>
                    <th v-if="editRouteName">
                        Editar
                    </th>
                    <th v-if="deleteUrl">
                        Excluir
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="row in rows">
                    <td v-for="header in headers">
                        <router-link  
                            v-if="header.linkToShowPage"
                            :to="{ name: showRouteName, params: { id: row['id'] } }"
                            >{{row[header.field]}}</router-link>
                        <span v-else >
                            {{row[header.field]}}
                        </span>
                    </td>
                    <td v-if="editRouteName">
                        <router-link 
                            v-if="editRouteName" 
                            class="btn light-blue darken-4 white-text" 
                            :to="{ name: editRouteName, params: {id: row.id } }"
                            ><i class="material-icons right" aria-hidden="true">edit</i>
                            editar</router-link>
                    </td>
                    <td v-if="deleteUrl">
                        <button 
                            v-if="deleteUrl"
                            @click="sendDelete(row.id)"
                            class="btn grey darken-1"
                            ><i class="material-icons right" aria-hidden="true">cancel</i>
                            remover</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <div v-if="error" class="error-display">
            <div><b>Erro ao carregar: </b></div>
            <div>{{error}}</div>
        </div>

    </div>
</template>


<script>

var rows = {},
    error = null;


export default {
    props: [ 
        'deleteUrl',
        'editRouteName', 
        'hasPagination', 
        'headers',
        'url',
        'showRouteName'
    ],
    data() {
        return {
            rows,
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
            var url = this.url;
            if(!url ||  !this.headers){
                alert("configure as url's e os headers do fetch da tabela");
            }
            this.error = this.post = null
            this.$parent.$emit("changeloadingstatus", true);
            fetch(url)
                .then( resp => resp.json() )
                .then( data => {
                    this.setData(
                        this.hasPagination 
                            ? data.data 
                            : data
                    )
                })
                .catch( error => {
                    this.$parent.$emit("changeloadingstatus", false);
                    this.error = error
                })
        },
        getFormattedDeleteUrl(id){
            return this.deleteUrl.replace("${id}", id);
        },
        removeRow(){
            alert('Registro removido com sucesso.');
            this.fetchData();
        },
        sendDelete(id){
            if(!confirm('Confirma exclusão?')){
                return false;
            }
            fetch(this.getFormattedDeleteUrl(id), {
                method: 'DELETE',
                body: id
            })
                .then(response => {
                    if(response.status == 200){
                        this.removeRow();
                    } else {
                        throw new Error("Error ao tentar excluir");
                    }
                })
                .catch(error => alert(error))
        },
        setData(rows) {
            this.rows = rows;
            this.$parent.$emit("changeloadingstatus", false);
        }
    },
    computed: {
    },
};
</script>

<style lang="scss">
    .error-display{
        color: white;
        min-height: 60px;
        background: #a7a7a7;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>

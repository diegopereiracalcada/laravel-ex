<template>
    <form
        id="show-chamado-form" 
        v-if="chamado"
        v-on:submit.prevent="fecharChamado" 
        class="chamado"
        >
        <!--div class="edit-button">
            <i class="material-icons">edit</i>
        </div -->
        <div
            @click="salvarAlteracoes" 
            class="save-button">
            <i class="material-icons">save</i>
        </div>
        <div class="row">
            <div class="col s2">
                <label>Id</label>
                <input 
                    v-model="chamado.id" 
                    disabled />
            </div>
            <div class="col s6">
                <label>Aberto em</label>
                <input 
                    v-model="chamado.dt_abertura" 
                    disabled />
            </div>
            <div class="col s4">
                <label>Cliente</label>
                <input 
                    v-model="chamado.cliente_shortname" 
                    disabled />
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <label>Descrição</label>
                <input 
                    v-model="chamado.descricao" 
                    disabled />
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <textarea
                    id="observacao" 
                    v-model="chamado.observacao" 
                    class="materialize-textarea"
                    ></textarea>
                <label class="active" for="observacao">Observação</label>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <label>
                    <input type="checkbox" 
                            v-model="chamado.preventiva">
                    <span>Preventiva Inclusa</span>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <textarea 
                    id="solucao" 
                    v-model="chamado.solucao" 
                    class="materialize-textarea"
                    ></textarea>
                <label class="active" for="solucao">Solução</label>
            </div>
        </div>
        <input 
            v-model="chamado.status"
            type="hidden"
            />
        <div class="row">
            <button class="btn waves-effect waves-light red col s12">Encerrar Chamado</button> 
        </div>
    </form>
</template>

<script>
let loading = true,
    chamado = null;

const CHAMADO_SHOW_API_URL_PREFIX = "/api/chamados/";

export default {
    created() {
        this.fetchData(this.$route.params.id)
    },
    data(){
        return {
            chamado,
        }
    },
    methods: {
         fetchData (id) {
            this.error = null;

            fetch(CHAMADO_SHOW_API_URL_PREFIX + id)
                .then( resp => resp.json() )
                .then( data => { this.setData(data) } )
                .catch( error => {
                    this.loading = false
                    this.error = error
                })
        },
        setData(chamado) {
            this.chamado = chamado;
            this.loading = false
        },
        onSubmit(form){
            console.log('apenas para prevenir o submit por enquanto');
        },
        salvarAlteracoes(){
            console.log('salvando...', this.chamado);
            var url = '/api/chamados/' + this.chamado.id;

            fetch(url, {
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json, text-plain, */*",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                method: 'put',
                credentials: "same-origin",
                body: JSON.stringify(this.chamado)
            })
            .then((data) => {
                this.$router.push({ name: 'chamados.abertos' });
                this.$emit('sendsuccess', 'Chamado salvo com sucesso');
            })
            .catch(function(error) {
                console.log(error);
            });
            
        },
        fecharChamado(){
            if(this.chamado.solucao == null 
                || this.chamado.solucao.trim() == ''){

                    alert('Para fechar o chamado preencha a solução antes');
                    return false;
            }
            this.chamado.status = 'FECHADO';
            this.salvarAlteracoes();

        }
        
    },
    computed: {
        formAction(){
            return "/api/chamados/" + this.chamado.id;
        }
    },
}
</script>

<style lang="scss">
    .edit-button,
    .save-button {
        position: fixed;
        top: 0;
        right: 0;
        color: white;
        padding: 13px;
    }
    .save-button i{
        font-size: 30px;
    }
</style>
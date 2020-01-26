<template>
  <div class="resultado-busca row">
    <div style="display: flex; align-items: center; padding: 0px 32px; margin-bottom: 30px;">
      <input 
        @keyup="onInputBuscaInternaKeyup"
        class="input-busca-interna" 
        placeholder="Buscar..." 
        style="margin-right: 4px;"> 
      <i 
        @click="onBuscaInternaSubmit()"
        class="btn-buscar btn-buscar-interno material-icons sufix" 
        style="padding: 0px 10px; color: rgba(0, 0, 0, 0.54);"
        >search</i>
    </div>
    <div v-if="showSemChamadosMessage" class="empty-list row">
      <div class="col s12">
        <h4>Não foram encontrados resultados com as palavras: </h4>
        <h6>{{this.$route.params.palavras}}</h6>
      </div>
    </div>
    <Chamado 
      v-for="chamado in chamados"
      :chamado="chamado"
      v-bind:key="chamado.id" 
      />
  </div>
</template>

<script>
import Chamado from "../../components/chamados/Chamado";

const SEARCH_API_URL = "/api/busca?palavras=";

let chamados = [],
  error = "",
  showSemChamadosMessage = false,
  palavras;



export default {
  components: {
    Chamado
  },
  data() {
    return {
      chamados,
      error,
      showSemChamadosMessage
    };
  },
  created() {
    this.palavras = this.$route.params.palavras;
    this.$emit("changeloadingstatus", true);
    //this.error = null;
    this.fetchData(this.palavras);
  },
  methods: {
    collapseMenu(){
      $(".sidenav-overlay").click();
    },
    fetchData(palavras) {
      fetch(SEARCH_API_URL + palavras)
        .then(resp => resp.json())
        .then(data => {
          this.setData(data);
          this.highlight(palavras);
          this.collapseMenu();
        })
        .catch(error => {
          this.$emit("changeloadingstatus", false);
          this.error = error;
        });
    },
    highlight(palavras){
      var words = palavras;
      console.log('highlight words', words);
      setTimeout(function(){$(".resultado-busca").highlight(words)}, 100);
      setTimeout(function(){$(".resultado-busca").highlight(words)}, 200);
      setTimeout(function(){$(".resultado-busca").highlight(words)}, 700);
      setTimeout(function(){$(".resultado-busca").highlight(words)}, 1500);
    },
    onBuscaInternaSubmit(){
      this.setIsLoading(true);

      var palavras = $(".input-busca-interna").val();

      if(palavras == null || palavras.trim() == ''){
        alert('Preencha o campo de busca');
        return false;
      }

      this.showSemChamadosMessage = false;
      $(".resultado-busca").unhighlight();
      this.fetchData(palavras);

    },
    onInputBuscaInternaKeyup(e){
      if(e.which == 27){
        return false;
      }
      console.log('onInputBuscaInternaKeyup',e);
      
      
      if(this.showSemChamadosMessage){
        this.showSemChamadosMessage = false;
      }
      var palavras = $(".input-busca-interna").val();

      if(e.which == 10 || e.which == 13) {
        console.log("$(e.target).parent().find(.btn-buscar).click();", $(e.target).parent().find(".btn-buscar"));
        if(palavras == null || palavras.trim() == ''){
          alert('Preencha o campo de busca');
          return false;
        }
        this.onBuscaInternaSubmit();
      }
    },
    setData(chamados) {
      console.log("setdata", chamados);
      this.chamados = chamados;
      if(this.chamados.length < 1){
        this.showSemChamadosMessage = true;
      }
      this.$emit("changeloadingstatus", false);
    },
    setIsLoading(status){
      console.log("setIsLoading...")
      this.$emit("changeloadingstatus", status);
    }
  },
  watch: {
    $route: "fetchData"
  }
};
</script>

<style lang="scss">
.resultado-busca {
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

.empty-list h4 {
  color: #7d7d7d;
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
  50%,
  100% {
    top: 24px;
    height: 32px;
  }
}

.resultado-busca .empty-list{
  display: inline-block;
}

.btn-buscar{
  cursor: pointer;
}
</style>

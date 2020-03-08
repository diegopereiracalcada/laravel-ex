<template>
  <div class="resultado-busca row" style="padding-top: 1rem;">
    <div class="filters-wrapper">
      <form id="search-form">
        <div class="input-field col s12">
          <input 
            @keyup="onInputBuscaInternaKeyup"
            id="input-busca-interna"
            name="palavras" 
            class="input-busca-interna" 
            style="margin-right: 4px;"> 
          <label class="active">Descrição / Observação / Solução / Cliente</label>
        </div>
        <div class="input-field col s12">
          <input name="dt_abertura_start" class="datepicker">
          <label class="active">De: (Data de Abertura)</label>
        </div>
        <div class="input-field col s12">
          <input name="dt_abertura_end" class="datepicker">
          <label class="active">Até: (Data de Abertura)</label>
        </div>
        <div class="input-field col s12">
          <input name="dt_fechamento_start" class="datepicker">
          <label class="active">De: (Data de Fechamento)</label>
        </div>
        <div class="input-field col s12">
          <input name="dt_fechamento_end" class="datepicker">
          <label class="active">Até: (Data de Fechamento)</label>
        </div>
          <div class="input-field col s12">
            <select name="status">
              <option value="" selected>Todos</option>
              <option value="ABERTO">Aberto</option>
              <option value="FECHADO">Fechado</option>
            </select>
            <label>Status</label>
          </div>
      </form>
      <div class="col s12">
        <button
          class="btn btn-full-width"
          @click="onBuscaInternaSubmit()"
          >Buscar
            <i 
            class="btn-buscar btn-buscar-interno material-icons sufix" 
            style="padding: 0px 10px; color: rgba(0, 0, 0, 0.54);"
            >search</i>
        </button>
        </div>
    </div>

    <hr v-if="alreadySearched" class="float-hr">
    
    <div class="results-wrapper">
      <div v-if="noResults" class="empty-list row">
        <div class="col s12">
          <h4>Não foram encontrados resultados com as palavras: </h4>
          <h6>{{this.palavras}}</h6>
        </div>
      </div>
      
      <div v-if="alreadySearched" class="row">
        <div class="col s12">
          <label class="big-label">
            <span class="">{{chamados.length}}</span> resultados encontrados:
          </label>
        </div>
      </div>

      </div>
      <Chamado 
        v-for="chamado in chamados"
        :chamado="chamado"
        v-bind:key="chamado.id" 
        />
      </div>
  </div>
</template>

<script>
import Chamado from "../../components/chamados/Chamado";

const SEARCH_API_URL = "/api/busca";

let chamados = [],
  error = "",
  alreadySearched = false,
  noResults = false,
  palavras;

document.addEventListener("DOMContentLoaded", function() {
  if(document.getElementById("input-busca-interna")){
    document.getElementById("input-busca-interna").focus();
  }

  var elems = document.querySelectorAll('.datepicker');
  var instances = M.Datepicker.init(elems, {
    format: 'yyyy-mm-dd',
    autoClose: true,
    showClearBtn: true
  });
});

export default {
  components: {
    Chamado
  },
  data() {
    return {
      chamados,
      error,
      noResults
    };
  },
  created() {
    // this.palavras = this.$route.params.palavras;
    // this.setIsLoading(true);
    // this.error = null;
    // this.fetchData(this.palavras, );
  },
  methods: {
    collapseMenu(){
      $(".sidenav-overlay").click();
    },
    fetchData(formData) {
      let queryString = "?";
      let palavras;
      formData.forEach(function(obj){
        if(obj.value != null && obj.value.trim() != ''){
          if(obj.name == 'palavras'){
            this.palavras = ''
          }
          queryString += obj.name + "=" + obj.value + "&";
        }
      });

      fetch(SEARCH_API_URL + queryString)
        .then(resp => resp.json())
        .then(data => {
          console.log("data", data)
          this.setData(data);
          this.highlight(palavras);
          //this.collapseMenu();
          this.setIsLoading(false);
        })
        .catch(error => {
          this.setIsLoading(false);
          this.error = error;
        });
    },
    highlight(palavras){
      setTimeout(function(){$(".resultado-busca").highlight(palavras)}, 100);
      setTimeout(function(){$(".resultado-busca").highlight(palavras)}, 700);
      setTimeout(function(){$(".resultado-busca").highlight(palavras)}, 1200);
    },
    onBuscaInternaSubmit(){
      //this.setIsLoading(true);
      this.noResults = false;
      $(".resultado-busca").unhighlight();

     

      //this.palavras = $(".input-busca-interna").val();

      // if(this.palavras == null || this.palavras.trim() == ''){
      //   alert('Preencha o campo de busca');
      //   this.setIsLoading(false);

      //   return false;
      // }

      this.fetchData($( "#search-form" ).serializeArray());

    },
    onInputBuscaInternaKeyup(e){
      if(e.which == 27){
        return false;
      }
      
      if(this.noResults){
        this.noResults = false;
      }

      var palavras = $(".input-busca-interna").val();

      if(e.which == 10 || e.which == 13) {
        if(palavras == null || palavras.trim() == ''){
          alert('Preencha o campo de busca');
          return false;
        }
        this.onBuscaInternaSubmit();
      }
    },
    setData(chamados) {
      this.alreadySearched = true;
      this.chamados = chamados;

      if(this.palavras && this.chamados.length < 1){
        this.noResults = true;
      }
    },
    setIsLoading(status){
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

label.big-label {
    font-size: 1.4rem;
    margin-bottom: 2.3rem;
}
</style>

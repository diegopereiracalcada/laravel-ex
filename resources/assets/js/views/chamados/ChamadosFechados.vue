<template>
  <div class="chamados-fechados-list row">
    <div class="input-field col s12">
      <select
        @change="onOrdenationTypeChange($event)">
        <option value="DTFECHAMENTO_ASC">Data Fechamento Asc</option>
        <option value="DTFECHAMENTO_DESC" selected>Data Fechamento Desc</option>
        <option value="DTABERTURA_ASC">Data Abertura Asc</option>
        <option value="DTABERTURA_DESC">Data Abertura Desc</option>
      </select>
      <label>Ordenado por:</label>
    </div>

    <div v-if="showSemChamadosMessage" class="empty-list">
      <h4>Sem chamados fechados</h4>
    </div>
    <Chamado
      v-for="chamado in chamados"
      v-bind:key="chamado.id"
      :chamado="chamado"
      :mostrarDataFechamento="true"
      :mostrarBotaoReabrir="true"
      :mostrarSolucao="true"
      @refreshList="refreshList"
      />

    <div class="qtde-chamados-abertos bg-clickti-blue" style="
        position: fixed;
        top: 3px;
        right: 15px;
        z-index: 1;
        color: white;
        border: 2px solid white;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        margin-top: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        padding-top: 1px;
        font-weight: bold;
    ">{{qtdeChamadosFechados}}</div>
    
    <div v-if="error" class="messages-bar">
      <div><b>Erro: </b></div>
      <div>{{ error }}</div>
    </div>
  </div>
</template>

<script>
import Chamado from "../../components/chamados/Chamado";

const CHAMADOS_FECHADOS_INDEX_API_URL = "/api/fechados";

const orderByTypes = {
    DTFECHAMENTO_ASC: 'DTFECHAMENTO_ASC',
    DTFECHAMENTO_DESC: 'DTFECHAMENTO_DESC',
    DTABERTURA_ASC: 'DTABERTURA_ASC',
    DTABERTURA_DESC: 'DTABERTURA_DESC'
}

let chamados = [],
  error = "",
  showSemChamadosMessage = false,
  qtdeChamadosFechados;

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
    this.fetchChamadosFechados();
  },
  watch: {
    $route: "fetchChamadosFechados"
  },
  methods: {
    fetchChamadosFechados(orderBy) {
      this.$emit("changeloadingstatus", true);

      if(orderBy == null){
        orderBy = orderByTypes.DTABERTURA_ASC;
      }

      fetch(CHAMADOS_FECHADOS_INDEX_API_URL + "?orderBy=" + orderBy)
        .then(resp => resp.json())
        .then(data => {
          this.updateStatus();
          this.setData(data);
        })
        .catch(error => {
          this.$emit("changeloadingstatus", false);
          this.error = error;
        });
    },
    refreshList(){
      this.fetchChamadosFechados();
    },
    onOrdenationTypeChange(event){
      let choosedOption = event.target.value;
      this.fetchChamadosFechados(choosedOption);

    },
    setData(data) {
      this.chamados = data[0].chamados;
      this.qtdeChamadosFechados = data[0].qtdeChamados;
      if(this.chamados.length < 1){
        this.showSemChamadosMessage = true;
      }
      this.$emit("changeloadingstatus", false);
    },
    updateStatus(){
      var data = new Date();
      var horas = data.getHours();
      var minutos =  data.getMinutes() < 10 ? '0' + data.getMinutes() : data.getMinutes() ;
      
      var horario = horas + ':' + minutos;
      this.$emit("statusMessage", "Atualizado às " + horario);

    }
  }
};
</script>

<style lang="scss">
.chamados-fechados-list {
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
</style>

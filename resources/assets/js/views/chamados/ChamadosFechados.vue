<template>
  <div class="chamados-fechados-list row">
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

    <div v-if="error" class="messages-bar">
      <div><b>Erro: </b></div>
      <div>{{ error }}</div>
    </div>
  </div>
</template>

<script>
import Chamado from "../../components/chamados/Chamado";

const CHAMADOS_FECHADOS_INDEX_API_URL = "/api/fechados";

let chamados = [],
  error = "",
  showSemChamadosMessage = false;

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
    this.fetchData();
  },
  watch: {
    $route: "fetchData"
  },
  methods: {
    fetchData() {
      this.$emit("changeloadingstatus", true);

      fetch(CHAMADOS_FECHADOS_INDEX_API_URL)
        .then(resp => resp.json())
        .then(data => {
          this.updateStatus();
          this.setData(data);
        })
        .catch(error => {
          this.$emit("changeloadingstatus", false);
          console.log("Erro na resposta da reequisição", error);
          this.error = error;
        });
    },
    refreshList(){
      this.fetchData();
    },
    setData(chamados) {
      this.chamados = chamados;
      if(this.chamados.length < 1){
        this.showSemChamadosMessage = true;
      }
      this.$emit("changeloadingstatus", false);
    },
    updateStatus(){
      var data = new Date();
      var horas = data.getHours();
      var minutos = data.getMinutes();

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

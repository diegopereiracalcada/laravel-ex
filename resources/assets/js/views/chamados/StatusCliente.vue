<template>
  <div class="status-cliente-list row">
    <div class="nome-cliente">
      <span>{{chamados[0].name}}</span>
    </div>
    <div class="status-abertos">
      <h4>Chamados Abertos <span class="title-extension">(em ordem de prioridade)</span></h4>
      <table class="striped">
        <thead>
          <tr>
              <th>Id</th></th>
              <th>Descrição</th>
              <th>Aberto em</th>
          </tr>
        </thead>

        <tbody>
          <tr
            v-for="chamado in chamadosAbertos">
            <td>{{chamado.id}}</td>
            <td>{{chamado.descricao}}</td>
            <td>{{chamado.dt_abertura}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="status-fechados">
      <h4>Chamados Fechados Nos Últimos 15 dias</h4>
      <table class="striped">
        <thead>
          <tr>
              <th>Id</th>
              <th>Descrição</th>
              <th>Fechado em</th>
          </tr>
        </thead>

        <tbody>
          <tr
            v-for="chamado in chamados">
            <td>{{chamado.id}}</td>
            <td>{{chamado.descricao}}</td>
            <td>{{chamado.dt_fechamento}}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>

document.addEventListener("DOMContentLoaded", function(){
  console.log('DOMContentLoaded...');
  document.querySelector('.nav-items').remove()
  document.querySelector('.fixed-action-btn').remove()
});

const STATUS_CLIENTE_API_URL = "/api/statuscliente";


let chamados = [],
  showSemChamadosMessage = false,
  qtdeChamadosAbertos;

export default {
  components: {
  },
  data() {
    return {
      chamados,
      showSemChamadosMessage
    };
  },
  computed: {
    chamadosAbertos(){
      return this.chamados.filter(chamado => chamado.status == 'ABERTO');
    },
    chamadosFechados(){
      return this.chamados.filter(chamado => chamado.status == 'FECHADO');
    }
  },
  created() {
    this.$emit("changeloadingstatus", true);
    //LIMPAR MENU
    this.fetchStatusCliente();
  },
  watch: {
    $route: "fetchStatusCliente"
  },
  methods: {
    fetchStatusCliente() {
      fetch(STATUS_CLIENTE_API_URL)
        .then(resp => resp.json())
        .then(data => {
          this.setData(data);
          this.$emit("changeloadingstatus", false);
        })
        .catch(error => {
          this.$emit("changeloadingstatus", false);
          this.error = error;
        });
    },
    setData(data) {
      this.chamados = data[0].chamados;
      this.qtdeChamadosAbertos = data[0].qtdeChamados;

      if(this.chamados.length < 1){
        this.showSemChamadosMessage = true;
      }
    }
  }
};
</script>

<style lang="scss">
.title-extension{

    font-size: 1.3rem;
    color: #8a8a8a;
}

.nome-cliente {
    position: fixed;
    top: 20px;
    right: 14px;
    color: white;
    font-weight: bold;
}
</style>

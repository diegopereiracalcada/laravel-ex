<template>
  <div>
    <ul v-if="cliente" class="collapsible">
      <li>
        <div class="collapsible-header">
          <i class="material-icons">details</i>Sobre
        </div>
        <div class="collapsible-body">
          <div class="row">
            <div class="col s12">
              <label>shortname</label>
              <input v-model="cliente.shortname" disabled />
            </div>
          </div>
          <div class="row">
            <div class="col s12">
              <label>status</label>
              <input v-model="cliente.status" disabled />
            </div>
          </div>
          <div class="row">
            <div class="col s12">
              <label>Nome</label>
              <input v-model="cliente.name" disabled />
            </div>
          </div>
          <div class="row">
            <div class="col s12">
              <label>email</label>
              <input v-model="cliente.email" disabled />
            </div>
          </div>
          <div class="row">
            <div class="col s12">
              <label>telefone</label>
              <input v-model="cliente.telefone" disabled />
            </div>
          </div>
          <div class="row">
            <div class="col s12">
              <label>endereco</label>
              <input v-model="cliente.endereco" disabled />
            </div>
          </div>
          <div class="row">
            <div class="col s12">
              <label>cep</label>
              <input v-model="cliente.cep" disabled />
            </div>
          </div>
          <div class="row">
            <div class="col s12">
              <label>natureza</label>
              <input v-model="cliente.natureza" disabled />
            </div>
          </div>
          <div class="row">
            <div class="col s12">
              <label>cpfcnpj</label>
              <input v-model="cliente.cpfcnpj" disabled />
            </div>
          </div>
          <div class="row">
            <div class="col s12">
              <label>vencimento</label>
              <input v-model="cliente.vencimento" disabled />
            </div>
          </div>
          <div class="row">
            <div class="col s12">
              <label>valor</label>
              <input v-model="cliente.valor" disabled />
            </div>
          </div>
        </div>
      </li>
      <li>
        <div class="collapsible-header">
          <i class="material-icons">event_note</i>Keep
        </div>
        <div class="collapsible-body">
          <span>Lorem ipsum dolor sit amet.</span>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
let loading = true,
  cliente = null;

const CLIENTE_SHOW_API_URL_PREFIX = "/api/clientes/";

export default {
  mounted() {},
  created() {
    this.fetchData(this.$route.params.id);
  },
  data() {
    return {
      cliente
    };
  },
  methods: {
    fetchData(id) {

      this.error = null;

      fetch(CLIENTE_SHOW_API_URL_PREFIX + id)
        .then(resp => resp.json())
        .then(data => {
          this.setData(data);
        })
        .catch(error => {
          this.loading = false;
          this.error = error;
        });
    },
    setData(cliente) {
      this.cliente = cliente;
      this.initializeCollapsibles();
      this.loading = false;
    },
    initializeCollapsibles() {
      console.log("initializeCollapsibles");
      setTimeout(function(){
         var elems = document.querySelectorAll(".collapsible");
      var instances = M.Collapsible.init(elems);
      }, 500);
    }
  }
};
</script>

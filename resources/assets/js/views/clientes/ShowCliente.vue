<template>
  <div>
    <ul v-if="cliente" class="collapsible show-cliente-component">
      <li>
        <div class="collapsible-header">
          <i class="material-icons">details</i>Sobre
        </div>
        <div class="collapsible-body">
          <div class="row">
            <div class="col s6">
              <label>shortname</label>
              <input v-model="cliente.shortname" disabled />
            </div>
            <div class="col s6">
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
            <div class="col s6">
              <label>telefone</label>
              <input v-model="cliente.telefone" disabled />
            </div>
            <div class="col s6">
              <label>cep</label>
              <input v-model="cliente.cep" disabled />
            </div>
          </div>
          <div class="row">
            <div class="col s12">
              <label>endereco</label>
              <input v-model="cliente.endereco" disabled />
            </div>
          </div>
          <div class="row">
            <div class="col s2">
              <label>natureza</label>
              <input v-model="cliente.natureza" disabled />
            </div>
            <div class="col s10">
              <label>cpfcnpj</label>
              <input v-model="cliente.cpfcnpj" disabled />
            </div>
          </div>
          <div class="row">
            <div class="col s6">
              <label>vencimento</label>
              <input v-model="cliente.vencimento" disabled />
            </div>
            <div class="col s6">
              <label>valor</label>
              <input v-model="cliente.valor" disabled />
            </div>
          </div>
        </div>
      </li>
      <li>
        <div class="collapsible-header">
          <i class="material-icons">event_note</i>
          <span>Keep (não implementado)</span>
          <i 
            class="material-icons expandable-trigger"
            >keyboard_arrow_down</i>
        </div>
        <div class="collapsible-body">
          <div class="sub-collapsible-item">
            <div class="sub-collapsible-item-header" >
              <i
                @click="onKeepItemExpTriggerClick($event)" 
                class="material-icons sub-collapsible-item-trigger">add</i>
              <span>Teste</span>
            </div> 
            <div class="sub-collapsible-item-content">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
              ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco 
              laboris nisi ut aliquip ex ea commodo consequat.</p>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
              ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco 
              laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
          </div>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>

let cliente = null;

const CLIENTE_SHOW_API_URL_PREFIX = "/api/clientes/";

export default {
  mounted() { },
  created() {
    this.$emit("changeloadingstatus", true);
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
          this.registerCollapsibles();
        })
        .catch(error => {
          this.error = error;
          this.$emit("changeloadingstatus", false);
        });
    },
    onKeepItemExpTriggerClick(event){
      var targetElement = event.target;
      console.log("triggou2", targetElement.innerText);

      if(targetElement.innerText == "add"){
          targetElement.innerText = "remove";
      } else {
          targetElement.innerText = "add";
      }

      var jParentWrapper = $(targetElement).parents(".sub-collapsible-item");
      var jItemToExpand = jParentWrapper.find(".sub-collapsible-item-content");
      
      if(jItemToExpand.css("max-height") == "4000px"){
        jItemToExpand.css("max-height", "0px");
      } else {
        jItemToExpand.css("max-height", "4000px");
      }
    },
    setData(cliente) {
      this.cliente = cliente;
      this.initializeCollapsibles();
      this.$emit("changeloadingstatus", false);
    },
    initializeCollapsibles() {
      setTimeout(function(){
        var elems = document.querySelectorAll(".collapsible");
        var instances = M.Collapsible.init(elems);
      }, 500);
    }
  }
};
</script>

<style lang="scss">
  .show-cliente-component label {
    color: black !important ;
  }

  .collapsible-body{
    padding: 1.3rem;

  }
  
  li.active .expandable-trigger{
    transform: rotate(180deg);
  }

  .expandable-trigger{
    margin-left: auto; 
    margin-right: 0;
    transition: 0.6s;
  }

  .sub-collapsible-item-header{
    display: flex;
    align-items: center;
    background: #3b5473;

  }

  .sub-collapsible-item-trigger{
    padding: 0.3rem;
    margin-right: 1rem;
    background: #053244;
    color: white;
  }

  .sub-collapsible-item-header span{
    color: white;
    font-weight: bold;
  } 


  .sub-collapsible-item-content {
    padding: 0 18px;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.2s ease-out;
    background-color: #f1f1f1;
  } 
</style>
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
      <li class="active">
        <div class="collapsible-header">
          <i class="material-icons">event_note</i>
          <span>Keep (base de conhecimento)</span>
          <i 
            class="material-icons expandable-trigger"
            >keyboard_arrow_down</i>
        </div>
        <div class="collapsible-body">
          <div 
            v-for="categoria in categorias"
            class="sub-collapsible-item sub-collapsed">
            <div 
              class="sub-collapsible-item-header"
              @click="onKeepItemHeaderClick($event)"   >
              <input name="nota_id" type="hidden" :value="getNotas(categoria.categoria)[0].id" />
              <i
                class="material-icons sub-collapsible-item-trigger">add</i>
              <span>{{categoria.categoria | capitalize}}</span>
              <div class="action-buttons-wrapper" style="margin-left: auto;">
                <i
                  @click="onKeepItemEditClick($event)"
                  class="material-icons sub-collapsible-item-edit">edit</i>
                <i
                  @click="onKeepItemConfirmClick($event)"
                  class="material-icons sub-collapsible-item-confirm">check</i>
                <i
                  @click="onKeepItemCancelClick($event)"
                  class="material-icons sub-collapsible-item-cancel">close</i>
              </div>
            </div> 
            <div 
              v-for="nota in getNotas(categoria.categoria)"
              class="sub-collapsible-item-content">
              <textarea 
                class="no-border-when-disabled"
                disabled="disabled">{{nota.nota}}</textarea>
            </div>
          </div>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>

let cliente = null,
  categorias,
  notas;

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
  filters: {
    capitalize: function (value) {
      if (!value) return ''
      value = value.toString()
      return value.charAt(0).toUpperCase() + value.slice(1)
    }
  },
  methods: {
    getNotas(categoria){
      return this.notas.filter(function(nota){
        return nota.categoria == categoria;
      })
    },
    fetchData(id) {
      this.error = null;

      fetch(CLIENTE_SHOW_API_URL_PREFIX + id)
        .then(resp => resp.json())
        .then(data => {
          this.setData(data);
          this.fixTextAreaHeight();
        })
        .catch(error => {
          this.error = error;
          this.$emit("changeloadingstatus", false);
        });
    },
    fixTextAreaHeight() {
      setTimeout(function(){$('textarea').each(function () {
          $(this).height($(this).prop('scrollHeight'));
      })}, 500);
    },
    onKeepItemEditClick(event){
      event.stopPropagation();
      var targetElement = event.target;
      this.toggleEditMode(targetElement);
    },
    toggleTextArea(elem){
      var textareaElem = $(elem).parents(".sub-collapsible-item").find("textarea");
      var isDisabled = textareaElem.attr("disabled");
      textareaElem.attr("disabled", !isDisabled);
    },
    toggleEditMode(elem){
      this.toggleTextArea(elem);

      var jHeader = $(elem).parents(".sub-collapsible-item-header");
      jHeader.toggleClass("edit-mode");
    },
    onKeepItemConfirmClick(event){
      event.stopPropagation();
      
      var jElemNota = $(event.target).parents(".sub-collapsible-item");
      var idNota = jElemNota.find("[name='nota_id']").val() ;
      var newNotaText = jElemNota.find(".sub-collapsible-item-content textarea").val();

      var nota = { "id": idNota, "nota": newNotaText };

      if(confirm("Salvar alterações?")){
        this.sendUpdateNota(nota, event.target);
      }
    },
    onKeepItemCancelClick(event){
      event.stopPropagation();
      if(confirm("Confirma?")){
        var targetElement = event.target;
        this.toggleEditMode(targetElement);
      }

    },
    onKeepItemHeaderClick(){
      var targetElement = event.target;
      var jParentWrapper = $(targetElement).parents(".sub-collapsible-item");
      var jExpandableContent = jParentWrapper.find(".sub-collapsible-item-content");
      var isExpanded = !jParentWrapper.hasClass("sub-collapsed");

      if(jParentWrapper.find(".sub-collapsible-item-header").hasClass("edit-mode")){
        return;
      }

      if(isExpanded){
        $(targetElement).find(".sub-collapsible-item-trigger")[0].innerText = "add";
        jExpandableContent.css("max-height", "0px");
        jParentWrapper.find(".sub-collapsible-item-edit").hide();
        jParentWrapper.addClass("sub-collapsed");
        jParentWrapper.removeClass("sub-expanded");
      } else {
        $(targetElement).find(".sub-collapsible-item-trigger")[0].innerText = "remove";
        jExpandableContent.css("max-height", "4000px");
        jParentWrapper.find(".sub-collapsible-item-edit").show();
        jParentWrapper.addClass("sub-expanded");
        jParentWrapper.removeClass("sub-collapsed");
      }

    },
    sendUpdateNota(nota, targetElement) {
      this.$emit("changeloadingstatus", true);

      var url = "/api/notas/" + nota.id;

      fetch(url, {
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json, text-plain, */*",
          "X-Requested-With": "XMLHttpRequest",
          "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content")
        },
        method: "put",
        credentials: "same-origin",
        body: JSON.stringify(nota)
      })
        .then(response => {
            this.$emit("changeloadingstatus", false);

          if (response.ok) {
            this.$emit("sendsuccess", "Nota salva com sucesso");
            this.toggleEditMode(targetElement);
            this.fixTextAreaHeight();
          } else {
            alert(response.statusText);
            this.$emit("senderror", response.statusText);

          }
        })
    },
    setData(cliente) {
      this.cliente = cliente;
      this.categorias = cliente.categorias;
      this.notas = cliente.notas;
      this.initializeMaterializeCollapsibles();
      this.$emit("changeloadingstatus", false);
    },
    initializeMaterializeCollapsibles() {
      setTimeout(function(){
        var elems = document.querySelectorAll(".collapsible");
        var instances = M.Collapsible.init(elems);
      }, 500);
    }
  }
};
</script>

<style lang="scss">

  .action-buttons-wrapper{
    margin-right: 0.8rem;
  }

  .sub-collapsed .action-buttons-wrapper{
    display: none;
  }
  .sub-collapsible-item-header.edit-mode .sub-collapsible-item-edit,
  .sub-collapsible-item-header:not(.edit-mode) .sub-collapsible-item-confirm,
  .sub-collapsible-item-header:not(.edit-mode) .sub-collapsible-item-cancel{
    display: none;
  }

  i.material-icons.sub-collapsible-item-confirm,
  i.material-icons.sub-collapsible-item-cancel {
    color: white;
    cursor: pointer;
}

  .show-cliente-component label {
    color: black !important ;
  }

  .collapsible-body{
    padding: 0.5rem;

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
    cursor: pointer;
  }

  .sub-collapsible-item{
    margin-bottom: 0.2rem;

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

  .sub-collapsible-item-edit {
      color: white;
      margin-left: auto;
      margin-right: 0.5rem;
      cursor: pointer;
  }
</style>
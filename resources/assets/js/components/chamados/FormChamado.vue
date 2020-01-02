<template>
  <form
    id="show-chamado-form"
    v-if="chamado"
    v-on:submit.prevent="onSubmit"
    class="chamado"
  >
    <div v-if="updateMode" @click="sendUpdateChamado" class="save-button">
      <i class="material-icons">save</i>
    </div>
    <div class="row" v-if="this.updateMode">
      <div class="col s2">
        <label>Id</label>
        <input v-model="chamado.id" disabled />
      </div>
      <div class="col s6">
        <label>Aberto em</label>
        <input v-model="chamado.dt_abertura" disabled />
      </div>
      <div class="col s4">
        <label>Cliente</label>
        <input v-model="chamado.cliente_shortname" disabled />
      </div>
    </div>
    <div class="row">
      <div class="col s12">
        <label>Descrição</label>
        <input v-model="chamado.descricao" :disabled="updateMode" />
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
          <input type="checkbox" v-model="chamado.preventiva" />
          <span>Preventiva Inclusa</span>
        </label>
      </div>
    </div>
    <div class="row" v-if="!updateMode">
      <div class="col s12">
        <label>
          <input @change="onStatusChange" type="checkbox" />
          <span>Já resolvido</span>
        </label>
      </div>
    </div>
    <input type="hidden" v-model="chamado.status" />
    <div class="row" v-if="updateMode || chamado.status == 'FECHADO'">
      <div class="input-field col s12">
        <textarea
          id="solucao"
          v-model="chamado.solucao"
          class="materialize-textarea"
        ></textarea>
        <label class="active" for="solucao">Solução</label>
      </div>
    </div>

    <div class="row" v-if="updateMode">
      <button class="btn waves-effect waves-light red col s12">
        Encerrar Chamado
      </button>
    </div>
    <div class="row" v-else>
      <button class="btn waves-effect waves-light green col s12">
        Abrir Chamado
      </button>
    </div>
  </form>
</template>

<script>
let chamado = {
  status: "ABERTO"
};

const CHAMADO_SHOW_API_URL_PREFIX = "/api/chamados/";

export default {
  props: ["updateMode"],
  created() {
    if (false) {
      // this.updateMode
      this.$emit("changeloadingstatus", true);
      this.fetchData(this.$route.params.id);
    }
  },
  data() {
    return {
      chamado
    };
  },
  methods: {
    abrirChamado() {
      console.log("abrirChamado", this.chamado);
      if (
        this.chamado.descricao == null ||
        this.chamado.descricao.trim() == ""
      ) {
        alert("Preencha a descrição para abrir o chamado");
        return false;
      }

      this.$emit("changeloadingstatus", true);
      this.sendAberturaChamado();
    },
    fecharChamado() {
      if (this.chamado.solucao == null || this.chamado.solucao.trim() == "") {
        alert("Para fechar o chamado preencha a solução antes");
        return false;
      }

      this.$emit("changeloadingstatus", true);
      this.chamado.status = "FECHADO";
      this.sendUpdateChamado();
    },
    fetchData(id) {
      fetch(CHAMADO_SHOW_API_URL_PREFIX + id)
        .then(resp => resp.json())
        .then(data => {
          this.setData(data);
        })
        .catch(error => {
          this.$emit("changeloadingstatus", false);
          this.$emit("senderror", error);
        });
    },
    onSubmit(form) {
      console.log("apenas para prevenir o submit por enquanto");
      if (this.updateMode) {
        this.fecharChamado();
      } else {
        this.abrirChamado();
      }
    },
    onStatusChange(event) {
      console.log("onStatusChange");

      this.chamado.status = event.target.checked ? "FECHADO" : "ABERTO";

      if (!event.target.checked) {
        delete this.chamado.solucao;
      }
    },
    sendAberturaChamado() {
      var url = "/api/chamados";

      fetch(url, {
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json, text-plain, */*",
          "X-Requested-With": "XMLHttpRequest",
          "X-CSRF-TOKEN": document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content")
        },
        method: "post",
        credentials: "same-origin",
        body: JSON.stringify(this.chamado)
      })
        .then(response => {
          if (response.ok) {
            this.$emit("changeloadingstatus", false);
            this.$router.push({ name: "chamados.abertos" });
            this.$emit("sendsuccess", "Chamado aberto com sucesso");
          } else {
            alert(response.statusText);
                        console.log("this", this)

            this.$emit("senderror", response.statusText);
          }
        })
    },
    sendUpdateChamado() {
      var url = "/api/chamados/" + this.chamado.id;

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
        body: JSON.stringify(this.chamado)
      })
        .then(data => {
          console.log("then1", data);
          if (response.ok) {
            this.$emit("changeloadingstatus", false);
            this.$router.push({ name: "chamados.abertos" });
            this.$emit("sendsuccess", "Chamado salvo com sucesso");
          } else {
            alert(response.statusText);
            this.$emit("senderror", response.statusText);
          }
        })
    },
    setData(chamado) {
      this.chamado = chamado;
      this.$emit("changeloadingstatus", false);
    }
  },
  computed: {
    formAction() {
      return "/api/chamados/" + this.chamado.id;
    }
  }
};
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
.save-button i {
  font-size: 30px;
}
</style>

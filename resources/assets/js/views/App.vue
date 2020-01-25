<template>
  <div>
    <navbar></navbar>
    <main class="vue-router-wrapper">
      <router-view
        v-on:sendsuccess="successMessageHandler"
        v-on:senderror="errorMessageHandler"
        v-on:changeloadingstatus="changeloadingstatusHandler"
        v-on:statusMessage="setStatusMessage"
      ></router-view>
    </main>
    <div v-if="loading" class="loading-wrapper">
      <div class="lds-facebook">
        <div></div>
        <div></div>
        <div></div>
      </div>
    </div>
    <div class="fixed-action-btn">
      <router-link 
        :to="{ name: 'chamados.abrir' }" 
        class="btn-floating btn-large red">
        <i class="bg-clickti-blue large material-icons">add</i>
      </router-link>
    </div>
    <div class="footer-status">
      {{statusMessage}}
    </div>
  </div>
</template>

<script>
import Navbar from "../components/Navbar";

let loading = false,
  statusMessage = '';

export default {
  name: "App",
  components: {
    Navbar
  },
  data() {
    return {
      loading,
      statusMessage
    };
  },
  methods: {
    successMessageHandler(msg) {
      iziToast.success({
        message: msg
      });
    },
    errorMessageHandler(msg) {
      iziToast.error({
        message: msg
      });
    },
    changeloadingstatusHandler(status) {
      this.loading = status;
    },
    setStatusMessage(msg){
      this.statusMessage = msg;
    }
  }
};
</script>

<style lang="scss">

</style>

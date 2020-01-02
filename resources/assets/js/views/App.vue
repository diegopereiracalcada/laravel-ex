<template>
  <div>
    <navbar></navbar>
    <main class="vue-router-wrapper">
      <router-view
        v-on:sendsuccess="successMessageHandler"
        v-on:senderror="errorMessageHandler"
        v-on:changeloadingstatus="changeloadingstatusHandler"
      ></router-view>
    </main>
    <div v-if="loading" class="loading-wrapper">
      <div class="lds-facebook">
        <div></div>
        <div></div>
        <div></div>
      </div>
    </div>
  </div>
</template>

<script>
import Navbar from "../components/Navbar";

let loading = false;

export default {
  name: "App",
  components: {
    Navbar
  },
  data() {
    return {
      loading
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
    }
  }
};
</script>

<style lang="scss">
.loading-wrapper {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  z-index: 10;
  display: flex;
  justify-content: center;
  align-items: center;
  background: #3e3b3b94;
}

.loading-wrapper img {
  width: 60% !important;
  height: 30% !important;
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

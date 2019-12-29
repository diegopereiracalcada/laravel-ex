<template>
    <div>
        <navbar></navbar>
        <main class="vue-router-wrapper">
            <router-view
                v-on:sendsuccess="successMessageHandler"
                v-on:senderror="errorMessageHandler"
            ></router-view>
        </main>
    </div>
</template>

<script>
import Navbar from "../components/Navbar";

export default {
    name: "App",
    components: {
        Navbar
    },
    methods: {
        successMessageHandler(msg) {
            console.log("successMessageHandler", msg, );
            iziToast.success({
                message: msg,
            });
        },
        errorMessageHandler(msg) {
            console.log("errorMessageHandler", msg);
            iziToast.error({
                message: msg,
            });
        }
    }
};
</script>

<style lang="scss">
</style>

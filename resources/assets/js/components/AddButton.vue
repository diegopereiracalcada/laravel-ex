<template>
    <div class="row" style="margin-top: 20px;">
        <router-link 
            class="btn waves-effect waves-light light-blue darken-4"
            :to="{ name: addRouteName }"
            >Adicionar</router-link>
    </div>
</template>

<script>
export default {
    props: [
        'addRouteName'
    ],
    data() {
        return {};
    }
};
</script>

<style lang="scss">
</style>

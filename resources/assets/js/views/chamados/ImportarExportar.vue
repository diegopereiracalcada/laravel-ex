<template>
  <div class="row importar-exportar-container">
    <a
      href="/api/downloadExcel"
      class="btn"
      >Exportar Chamados para Excel
    </a>
  </div>
</template>

<script>
export default {
  methods: {
    exportarChamados(){
      console.log("exportarChamados...");
    }
  },
};
</script>

<style lang="scss">
.importar-exportar-container{
  display:flex;
  justify-content: center;
  padding-top: 2rem;
}
</style>

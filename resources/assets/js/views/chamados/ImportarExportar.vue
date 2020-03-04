<template>
  <div class="row importar-exportar-container container">
    <div class="exportar-wrapper col s12">
      <h5>Exportação de chamados</h5>
      <a
        href="/api/downloadExcel"
        class="btn btn-large bg-clickti-blue full-width"
        >Exportar para Excel
      </a>
    </div>
    <div class="importar-wrapper col s12">
      <h5>Importação de chamados</h5>
      <form 
        action="/api/importExcel" 
        method="post" 
        class="form-horizontal" 
        enctype="multipart/form-data"
        ><input type="file" name="import_file" />
		  	<button class="btn btn-large bg-clickti-blue full-width">Importar planilha</button>
		</form>
    </div>
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
  padding-top: 2rem;
}
.importar-wrapper{
  margin-top: 2rem;
}

</style>

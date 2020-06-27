<template>
  <div>
    <div class="row importar-exportar-container container">
      <div class="exportar-wrapper col s12">
        <h5>Exportação de Clientes</h5>
        <a
          href="/api/downloadExcelClientes"
          class="btn btn-large bg-clickti-blue full-width"
          >EXPORTAR CLIENTES
        </a>
      </div>
      <div class="importar-wrapper col s12">
        <h5>Importação de Preventivas</h5>
        <form 
          action="/api/importExcelPreventivas" 
          method="post" 
          class="form-horizontal" 
          enctype="multipart/form-data"
          ><input type="file" name="import_file" />
          <button class="btn btn-large bg-clickti-blue full-width">IMPORTAR PREVENTIVAS</button>
        </form>
      </div>
    </div>
    <div class="row importar-exportar-container container">
      <div class="exportar-wrapper col s12">
        <h5>Exportação de chamados</h5>
        <a
          href="/api/downloadExcel"
          class="btn btn-large bg-clickti-blue full-width"
          >EXPORTAR CHAMADOS
        </a>
      </div>
      <div class="importar-wrapper col s12">
        <h5>Importação de chamados</h5>
        <form 
          action="/api/importExcelChamados" 
          method="post" 
          class="form-horizontal" 
          enctype="multipart/form-data"
          ><input type="file" name="import_file" />
          <button class="btn btn-large bg-clickti-blue full-width">IMPORTAR CHAMADOS</button>
      </form>
      </div>
    </div>
    <div class="row importar-exportar-container container">
      <div class="exportar-wrapper col s12">
        <h5>Exportação de Notas</h5>
        <a
          href="/api/downloadExcelNotas"
          class="btn btn-large bg-clickti-blue full-width"
          >EXPORTAR NOTAS
        </a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
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

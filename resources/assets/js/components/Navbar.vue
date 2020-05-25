<template>
    <div>
        <nav>
            <div class="nav-wrapper azul-click">
                <a href="#" data-target="slide-out" class="sidenav-trigger"
                    ><i class="material-icons">menu</i></a>
                <a href="javascript:void(0)" class="brand-logo">{{$route.meta.title || 'Click TI'}}</a>
                
                <ul class="nav-items right hide-on-med-and-down">
                    <li v-for="item in menuItens">
                        <a :href="item.href">{{ item.label }}</a>
                    </li>
                </ul>
            </div>
        </nav>

        <ul id="slide-out" class="sidenav">
            <li class="user-view">
                    <img class="" src="/images/logo_60x60.jpg" />
            </li>
            <!--li style="
                    display: flex;
                    align-items: center;
                    padding: 0 32px;
                    margin-bottom: 20px;
                "><input 
                    @keyup="onInputBuscaKeyup"
                    class="input-busca" placeholder="Buscar..." 
                    style="margin-left: 25px;margin-right: 4px;"> 
                    <i 
                        @click="onBuscaSubmit()"
                        class="material-icons sufix" 
                        style="padding: 0 10px; color: rgba(0,0,0,0.54);">search</i>
            </li-->
            <li 
                v-for="item in menuItens"
                :class="item.classes">
                <a :href="item.href"
                    ><i class="material-icons">{{ item.icon }}</i
                    >{{ item.label }}</a>
            </li>
            <li class="versao" style="
                position: absolute;
                bottom: 60px;
                color: rgb(142, 141, 141);
                width: 100%;
                text-align: center;
                left: 0;
            ">v1.3</li>
        </ul>
    </div>
</template>

<script>
var menuItens = [
    {
        label: "Abrir Chamado",
        icon: "add_circle",
        href: "/abrir"
    },
    {
        label: "Buscar",
        icon: "search",
        href: "/resultadobusca"
    },
    {
        label: "Chamados Abertos",
        icon: "clear_all",
        href: "/chamados"
    },
    {
        label: "Chamados Fechados",
        icon: "business_center",
        href: "/fechados"
    },
    {
        label: "Clientes",
        icon: "contacts",
        href: "/clientes"
    },
    // {
    //     label: "Importar/Exportar",
    //     icon: "import_export",
    //     href: "/importarexportar"
    // },
    {
        label: "Itinerário",
        icon: "directions",
        href: "/itinerario"
    }
];

document.addEventListener("DOMContentLoaded", function() {
    initializeMaterialize();
});

function initializeMaterialize() {
    var elems = document.querySelectorAll(".sidenav");
    var instances = M.Sidenav.init(elems);
}

export default {
    data() {
        return { menuItens };
    },
    methods: {
        collapseMenu(){
            $(".sidenav-overlay").click();
        },
        onBuscaSubmit(){
            var palavras = $(".input-busca").val();
            if(this.$route.name == 'resultadobusca'){
                var textoBuscado =  $(".input-busca").val();
                $(".input-busca-interna").val(textoBuscado);
                $(".btn-buscar-interno").click();
                this.collapseMenu();
            }

            $(".input-busca").val("");
            this.$router.push({name: 'resultadobusca', params: { palavras: palavras }});

        },
        onInputBuscaKeyup(e){
            if(e.which == 27){
                return false;
            }
            
            var palavras = $(".input-busca").val();

            if(e.which == 10 || e.which == 13) {
                if(palavras == null || palavras.trim() == ''){
                    alert('Preencha o campo de busca');
                    return false;
                }
                this.onBuscaSubmit();
            }
        },
    },
};
</script>

<style lang="scss">
.user-view {
    text-align: center;
}

.user-view img {
    width: 40%;
}

.azul-click {
    background-color: #053244 !important;
}

.brand-logo {
    padding: 0 14px !important;
}

.user-view {
    margin-bottom: 0 !important;
}
</style>

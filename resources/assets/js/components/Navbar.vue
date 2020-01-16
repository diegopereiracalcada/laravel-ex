<template>
    <div>
        <nav>
            <div class="nav-wrapper azul-click">
                <a href="#" data-target="slide-out" class="sidenav-trigger"
                    ><i class="material-icons">menu</i></a>
                <a href="javascript:void(0)" class="brand-logo">{{$route.meta.title || 'Click TI'}}</a>
                <ul class="right hide-on-med-and-down">
                    <li v-for="item in menuItens">
                        <a :href="item.href">{{ item.label }}</a>
                    </li>
                </ul>
            </div>
        </nav>

        <ul id="slide-out" class="sidenav">
            <li>
                <div class="user-view">
                    <img class="" src="/images/logo_60x60.jpg" />
                </div>
            </li>
            <li v-for="item in menuItens">
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
                /* padding: 30px; */
                left: 0;
            ">v0.3</li>
        </ul>
    </div>
</template>

<script>
var menuItens = [
    {
        label: "Itinerário",
        icon: "directions",
        href: "/itinerario"
    },
    {
        label: "Chamados Abertos",
        icon: "clear_all",
        href: "/chamados"
    },
    {
        label: "Abrir Chamado",
        icon: "add_circle",
        href: "/abrir"
    },
    {
        label: "Clientes",
        icon: "contacts",
        href: "/clientes"
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
    }
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
</style>

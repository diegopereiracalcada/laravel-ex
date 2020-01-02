<template>
    <div>
        <nav>
            <div class="nav-wrapper azul-click">
                <a href="#" data-target="slide-out" class="sidenav-trigger"
                    ><i class="material-icons">menu</i></a>
                <a href="#!" class="brand-logo">ClickTI</a>
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
        </ul>
    </div>
</template>

<script>
var menuItens = [
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

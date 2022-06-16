<script setup>
import { ref } from 'vue'
import { isActive } from "../../stores.js";

import BaseButton from './BaseButton.vue';

function horaireWeeklyDesktop() {

    if (isActive.value.monthly) {
        isActive.value.monthly = false;
        isActive.value.daily = false;
        isActive.value.weekly = true;
    }
    if (isActive.value.daily) {
        isActive.value.monthly = false;
        isActive.value.daily = false;
        isActive.value.weekly = true;
    }
    if (isActive.value.weekly) {
        isActive.value.monthly = false;
        isActive.value.daily = false;
        isActive.value.weekly = true;
    }



}
</script>

<template>

    <div>
        <div class="titre">
            <img @click="horaireWeeklyDesktop();" class="logo" src="../../../.././public/img/logo_organiz.svg" />
            <hr class="ligne1" />
        </div>
        <div class="liens">
            <div class="linkBox">
                <router-link to="/">
                    <p class="router">Horaires</p>
                </router-link>
            </div>
            <div class="linkBox">
                <router-link to="/">
                    <p class="router">Absences</p>
                </router-link>
            </div>
            <div class="linkBox">
                <!-- <router-link to="/"> -->
                <p class="router">Notes</p>
                <!-- </router-link> -->
            </div>
            <div class="linkBox">
                <router-link to="/">
                    <p class="router">Evaluation des cours</p>
                </router-link>
            </div>
            <div class="linkBox">
                <router-link to="/">
                    <p class="router">Compte</p>
                </router-link>
            </div>
        </div>
        <div id="separate">
            <hr class="ligne2" />
            <router-link to="/login">
                <base-button class="bouton">
                    Déconnexion
                </base-button>
            </router-link>
        </div>
    </div>
</template>

<style scoped>
.logo {

    cursor: pointer;
}

.router {
    margin: 0;
}


p {
    line-height: 1.4;
    color: var(--green);
    text-decoration: none;
    font-weight: bold;
}

.bouton {
    cursor: pointer;
    width: 100%;

}

p:hover {

    color: var(--orange);
}

.liens {
    flex: 1;
    padding-top: 5vh;
}

a {
    text-decoration: none;
    font-weight: bold;
    cursor: pointer;
}

.routerLogout {

    text-align: center;
}

.linkBox {
    padding: .7rem;
    margin-bottom: 2vh;
    background-color: var(--beige-transp);
    border-radius: var(--small-radius);
    cursor: pointer;

}

.ligne2 {
    margin-bottom: 2vh;
    height: 0;
    border: none;
    border-top: 2px solid #b8b8b8;

}

.titre {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
}


.ligne1 {
    /* margin-top: 5vh; */
    height: 0;
    width: 100%;
    border: none;
    border-top: 2px solid #b8b8b8;
}
</style>
<script setup>
import { ref } from 'vue'

import BaseButton from './BaseButton.vue';
</script>

<template>

    <div>
        <div class="titre">
            <img class="logo" src="../../../.././public/img/logo_organiz.svg" />
            <hr class="ligne1" />
        </div>
        <div class="liens">
            <div class="linkBox">
                <router-link to="/">
                    <p class="router">Horaires</p>
                </router-link>
                <span class="material-icons chevron">
                    chevron_right
                </span>
            </div>
            <div class="linkBox">
                <router-link to="/">
                    <p class="router">Absences</p>
                </router-link>
                <span class="material-icons chevron">
                    chevron_right
                </span>
            </div>
            <div class="linkBox">
                <!-- <router-link to="/"> -->
                    <p class="router">Notes</p>
                <!-- </router-link> -->
                <span class="material-icons chevron">
                    chevron_right
                </span>
            </div>
            <div class="linkBox">
                <router-link to="/">
                    <p class="router">Evaluation des cours</p>
                </router-link>
                <span class="material-icons chevron">
                    chevron_right
                </span>
            </div>
            <div class="linkBox">
                <router-link to="/">
                    <p class="router">Compte</p>
                </router-link>
                <span class="material-icons chevron">
                    chevron_right
                </span>
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


.router {
    margin: 0;
    font-size: .8rem;
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
    padding: .7rem 1rem;
    margin-bottom: 2vh;
    background-color: var(--beige-transp);
    border-radius: var(--small-radius);
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
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
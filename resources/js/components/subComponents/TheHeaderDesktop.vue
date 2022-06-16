<script setup>
import { ref } from 'vue'

import BaseButton from './BaseButton.vue';
</script>

<template>

    <div>
        <div class="titre">
            <h1 class="titreTexte">Organiz</h1>
            <hr class="ligne1" />
        </div>
        <div class="liens">
            <div class="linkBox">
                <router-link to="/">
                    <p class="router">Horaires</p>
                </router-link>
            </div>
            <div class="linkBox">
                <router-link to="/absences">
                    <p class="router">Absences</p>
                </router-link>
            </div>
            <div class="linkBox">
                <router-link to="/notes">
                    <p class="router">Notes</p>
                </router-link>
            </div>
            <div class="linkBox">
                <router-link to="/reviews">
                    <p class="router">Evaluation des cours</p>
                </router-link>
            </div>
            <div class="linkBox">
                <router-link to="/compte">
                    <p class="router">Compte</p>
                </router-link>
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
    </div>
</template>

<style scoped>
.bouton {

    width: 230%;
    cursor: pointer;
}

p {
    line-height: 3em;
    color: var(--green);
    text-decoration: none;
    font-weight: bold;
}

p:hover {

    color: var(--orange);
}

.liens {

    float: left;

}

.router {
    margin-left: 5%;
}

a {
    color: black;
    text-decoration: none;
    font-weight: bold;
}

.routerLogout {

    text-align: center;
}

.linkBox {
    display: flex;
    flex-direction: column;
    text-align: left;
    padding: 0.3em 0em;
    margin: 1em 5%;
    background-color: var(--beige);
    border-radius: 0.6rem;
    margin-bottom: 0%;
    width: 180%;
    height: 60px;
    margin-left: 10%;
    cursor: pointer;

}

#separate {
    display: grid;
    padding-left: 20px;
    padding-right: 15px;
    margin-top: 30vh;
}

.ligne2 {

    height: 0;
    width: 230%;
    border: none;
    border-top: 1px solid gray;

}

.titre {
    margin-top: 20%;
    text-align: center;
    height: 150px;
    width: 100%;
}


.ligne1 {
    padding-top: 50%;
    margin-left: 20px;
    margin-right: 15px;
    height: 0;
    width: 85%;
    border: none;
    border-top: 1px solid gray;


}
</style>
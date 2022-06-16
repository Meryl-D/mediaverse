<script setup>
import { ref } from 'vue'
import BaseButton from './BaseButton.vue';



const isActive = ref(false);

function menu() {

  isActive.value = !isActive.value;


}

</script>

<template>
  <div>

    <div>
      <div :class="!isActive ? 'active' : ''" class="menuBurger" @click="menu();">
        <span class="material-icons">menu</span>
        <span>
          <link
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        </span>
      </div>
    </div>

    <div :class="isActive ? 'shadow' : ''" class="fond"></div>

    <div :class="isActive ? 'active' : ''" class="menu" @click="menu();">
      <div>
        <div>
          <span class="material-icons close">close</span>
          <span>
            <link
              href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
          </span>
        </div>
        <div class="liens">
          <div class="linkBox">
            <p class="router">
              <router-link to="/"><a>Horaire</a></router-link>
            </p>
          </div>
          <div class="linkBox">
            <p class="router">
              <router-link to="/absences">Absences</router-link>
            </p>
          </div>
          <div class="linkBox">
            <p class="router">
              <router-link to="/notes">Notes</router-link>
            </p>
          </div>
          <div class="linkBox">
            <p class="router">
              <router-link to="/reviews">Evaluation des cours</router-link>
            </p>
          </div>
          <div class="linkBox">
            <p class="router">
              <router-link to="/compte">Compte</router-link>
            </p>
          </div>
          <div id="separate">
            <hr />
            <router-link to="/login">
              <base-button class="bouton">
                Déconnexion
              </base-button>
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
@import url("https://fonts.googleapis.com/icon?family=Material+Icons");

.bouton {

    width: 100%;
}

p {
  line-height: 3em;
}


.menuBurger {
  margin: 3% 0 0 2%;
  cursor: pointer;
  transition: all 0.5s;
  -webkit-transition: all 0.25s;
  position: absolute;

}

.close {
  margin: 5% 0 10% 88%;
  cursor: pointer;
  color: var(--orange);
}

/* .liens {

  margin: 0 0 0 8%;

} */

.router {

  margin-left: 5%;


}

a {
  color: var(--green);
  text-decoration: none;
  font-weight: bold;
}

.routerLogout {

  text-align: center;
}

.linkBox {
  flex-direction: column;
  text-align: left;
  padding: 0.3em 0em 0 0em;
  margin: 1em 5%;
  background-color: var(--beige);
  border-radius: 0.6rem;
  margin-bottom: 0%;

}

.menu {
  width: 92vw;
  height: 100vh;
  background-color: #FFFCFA;
  top: 0;
  position: absolute;
  left: -100%;
  transition: 0.5s;


}

.menu.active {
  /* filter: drop-shadow(41px 0px 0px rgba(0, 0, 0, 0.5)); */
  top: 0;
  left: 0;
  position: absolute;

}

.fond.shadow {
  position: absolute;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  /* right: 90; */
  background-color: rgba(0, 0, 0, 0.5);
  transition: 0.5s;

}

#separate {
  display: grid;
  margin-left: 5%;
  margin-right: 5%;
  margin-top: 60%;
}

hr {
  height: 0;
  border: none;
  border-top: 1px solid gray;

}

/* .deconnexion {
  flex-direction: column;
  text-align: left;
  padding: 0.3em 0em 0 0em;
  margin: 1em 5% 1em 5%;
  background-color: #FFFCFA;
  border-radius: 0.3rem 0.3rem 0.3rem 0.3rem;
  margin-bottom: 0%;
  text-align: center;
  filter: drop-shadow(0px 0px 10px #F1E3CD);
} */
</style>
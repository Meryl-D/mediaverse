<script setup>
import { ref, computed } from 'vue'
import BaseButton from './BaseButton.vue';
import { isActive }  from "../../stores.js";



const isMenuActive = ref(false);

const isWeeklySchedule = computed(() => {
  return isActive.value.weekly && window.location.pathname == '/'
})

function menu() {

  isMenuActive.value = !isMenuActive.value;

}

function horaireWeeklyMobile() {

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

  menu();

}
</script>

<template>
  <div>
    <div class="header-menu">
      <span class="material-icons menuBurger" :class="!isMenuActive ? 'active' : ''" @click="menu()">menu</span>
      <h1 v-if="isWeeklySchedule" class="schedule-title">Horaires et tâches</h1>
      <span class="material-icons">notifications</span>
    </div>

    <div :class="isMenuActive ? 'shadow' : ''" class="fond"></div>

    <div :class="isMenuActive ? 'active' : ''" class="menu">
        <div class="close-icon-ctn">
          <span class="material-icons close" @click="menu();">close</span>
        </div>
          <img @click="horaireWeekly();" class="logo" src="../../../.././public/img/logo_organiz.svg" />
        <div class="liens">
          <div class="linkBox" @click="menu();">
            <p class="router">
              <router-link to="/">Horaire</router-link>
            </p>
            <span class="material-icons chevron">
              chevron_right
            </span>
          </div>
          <div class="linkBox">
            <p class="router">
              <!-- <router-link to=""> -->
              Absences
              <!-- </router-link> -->
            </p>
            <span class="material-icons chevron">
              chevron_right
            </span>
          </div>
          <div class="linkBox">
            <p class="router">
              <!-- <router-link to=""> -->
              Notes
              <!-- </router-link> -->
            </p>
            <span class="material-icons chevron">
              chevron_right
            </span>
          </div>
          <div class="linkBox">
            <p class="router">
              <!-- <router-link to=""> -->
              Evaluation des cours
              <!-- </router-link> -->
            </p>
            <span class="material-icons chevron">
              chevron_right
            </span>
          </div>
          <div class="linkBox">
            <p class="router">
              <!-- <router-link to=""> -->
              Compte
              <!-- </router-link> -->
            </p>
            <span class="material-icons chevron">
              chevron_right
            </span>
          </div>
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
</template>

<style scoped>
@import url("https://fonts.googleapis.com/icon?family=Material+Icons");

.chevron {
  font-size: 24px;
}

.close-icon-ctn {
display:flex;
justify-content: flex-end;
}

.header-menu {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.schedule-title {
  margin: 0;
  font-size: clamp(1.7rem, 4vw, 2rem);
}

.logo {

  width: 60%;
  max-width: 250px;
  cursor: pointer;
  margin: 5vh 0;

}

.bouton {

  width: 100%;
}

p {
  line-height: 1.4;
  color: var(--green);
  text-decoration: none;
  font-weight: bold;
}


.menuBurger {
  cursor: pointer;
  transition: all 0.5s;
  -webkit-transition: all 0.25s;
}

.material-icons {
  color: var(--green);
}

.close {
  cursor: pointer;
  color: var(--orange);
}

.router {
  margin-bottom: 0;
  font-size: .9rem;
}

a {
  color: var(--green);
  text-decoration: none;
  font-weight: bold;
}

.routerLogout {

  text-align: center;
}

.liens {
  flex: 1;
}

.linkBox {
  padding: .7rem 1rem;
  margin-bottom: 3vh;
  background-color: var(--beige-transp);
  border-radius: var(--small-radius);
  cursor: pointer;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.menu {
  display: flex;
  flex-direction: column;
  width: 93vw;
  height: 100vh;
  background-color: #FFFCFA;
  top: 0;
  position: absolute;
  left: -100%;
  transition: 0.5s;
  padding: clamp(30px, 12%, 60px);

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
  /* margin-left: 5%;
  margin-right: 5%;
  margin-top: 60%; */
}

#separate hr {
  margin: 0 0 4vh 0;
  height: 0;
  border: none;
  border-top: 2px solid #b8b8b8;

}
</style>
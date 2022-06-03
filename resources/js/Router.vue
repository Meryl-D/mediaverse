<script setup>
import { ref, computed } from 'vue'
import Schedule from './Schedule.vue'
import Results from './Results.vue'
import Absences from './Absences.vue'
import Account from './Account.vue'
import NotFound from './NotFound.vue'

const routes = {
  '/': Schedule,
  '/notes' : Results,
  '/absences' : Absences,
  '/compte' : Account
}

const currentPath = ref(window.location.hash)

window.addEventListener('hashchange', () => {
  currentPath.value = window.location.hash
})

const currentView = computed(() => {
  return routes[currentPath.value.slice(1) || '/'] || NotFound
})
</script>

<template>
  <a href="#/">Schedule</a> |
  <a href="#/notes">Results</a> |
  <a href="#/absences">Absences</a> |
  <a href="#/compte">Account</a> |
  <component :is="currentView" />
</template>
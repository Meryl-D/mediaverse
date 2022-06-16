<script setup>
import { selectedDate, isActive } from "../../stores.js";




function goBackWeeklyView() {

  isActive.value.weekly = true;
  isActive.value.daily = false;
  isActive.value.monthly = false;
}
</script>

<template>
  <span 
    ><button class="go-back bold" @click="goBackWeeklyView()">&lt Horaires et tâches</button></span
  >
</template>

<style scoped>
.go-back {
  color: var(--green);
  background-color: var(--white);
  border: none;
}

button:hover,
button:active {
  color: var(--orange);
}
</style>
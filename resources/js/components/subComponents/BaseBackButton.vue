<script setup>
import { selectedDate, isActive } from "../../stores.js";


const props = defineProps({
  lessonDay: {
    type: Object,
    required: true,
  },
});

function goBackWeeklyView() {
  selectedDate.value = props.lessonDay;
  isActive.value.weekly = true;
  isActive.value.daily = false;
  isActive.value.monthly = false;
}
</script>

<template>
  <span class="go-back"
    ><button @click="goBackWeeklyView()">Horaire et tâches</button></span
  >
</template>

<style scoped>
button {
  color: var(--green);
  background-color: var(--white);
  border: none;
  border-radius: var(--small-radius);
  box-shadow: var(--shadow);
  padding: 0.3rem 0.6rem;
}

button:hover,
button:active {
  color: var(--orange);
}
</style>
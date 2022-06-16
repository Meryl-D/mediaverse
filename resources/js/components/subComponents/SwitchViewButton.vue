<script setup>
import { selectedDate, isActive } from "../../stores.js";

function changeCalendarView() {
  if (isActive.value.monthly) {
    isActive.value.monthly = false;
    isActive.value.daily = true;
  }
  if (isActive.value.daily) {
    isActive.value.monthly = true;
    isActive.value.daily = false;
  }
  console.log(isActive.value.daily, isActive.value.monthly);
}
</script>

<template>
  <div id="switchView" class="bold">
    <span>
      <button class="bold switch" @click="changeCalendarView()">
        <slot></slot>
      </button>
    </span>
  </div>
</template>

<style scoped>
#switchView {
  display: flex;
  color: var(--green);
  justify-content: flex-end;
  border: none;
}
.switch {
  /* color: var(--orange);
  background-color: var(--white); */
  color: var(--green);
  border: none;
}
</style>
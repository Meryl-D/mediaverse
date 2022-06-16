<script setup>
import { selectedDate, isActive } from "../../stores.js";

const props = defineProps({
  lessonDay: {
    type: Object,
    required: true,
  },
});

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
    <span >
      <button class="bold switch" @click="changeCalendarView()">
        {{ props.lessonDay.month }}
      </button>
    </span>
  </div>
</template>

<style scoped>
#switchView {
  display: flex;
  color: var(--orange);
  justify-content: flex-end;
  border: none;
}
.switch {
  color: var(--orange);
  background-color: var(--white);
  border: none;
 
}
</style>
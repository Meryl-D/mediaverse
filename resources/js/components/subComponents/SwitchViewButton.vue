<script setup>
import { selectedDate, isActive } from "../../stores.js";

const props = defineProps({
  lessonDay: {
    type: Object,
    required: true,
  },
});

function changeCalendarView() {
  console.log(isActive.value.daily, isActive.value.monthly);
  isActive.value.monthly = true;
  isActive.value.daily = false;
  // selectedDate.value = props.lessonDay;
  // isActive.value.daily = !isActive.value.daily;
  // isActive.value.monthly = !isActive.value.monthly;
  // console.log(isActive.value.daily, isActive.value.monthly)
}
</script>

<template>
  <div id="switchView">
    <span class="dropdown"
      ><button  @click="changeCalendarView()">
        {{ props.lessonDay.month }}
      </button></span
    >
  </div>
</template>

<style scoped>
#switchView {
  display: flex;
  color: var(--orange);
  justify-content: flex-end;
}
.dropdown {
  color: var(--orange);
  background-color: var(--white);
  border: none;
}
</style>
<script setup>
import { selectedDate } from "../../stores.js";

const props = defineProps({
  schedule: {
    type: Object,
    required: true,
  },
});

const currentMonthName = ref("");
currentMonthName = selectedDate.value.month;

const currentMonth = ref("");

//event listener for chosen month
function getMonth(m) {
  currentMonth.value = m.month.toLowerCase();
  selectedDate.value.month = m;
}

check();
watchEffect(() => {
  check();
});
</script>


<template>
  <div id="month-selected">
    <select v-model="selected">
      <option
        v-for="month in props.schedule.month"
        :key="month"
        v-bind:value="month.value.monthNb"
        @click="getMonth(month)"
      >
        {{ month.month }}
      </option>
    </select>
  </div>
</template>

<style scoped>
#month-selected {
  display: flex;
  color: var(--orange);
}
</style>
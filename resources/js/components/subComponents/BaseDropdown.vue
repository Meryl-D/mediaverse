<script setup>
import { selectedDate } from "../../stores.js";
import { ref, watchEffect } from "vue";
const props = defineProps({
  schedule: {
    type: Object,
    required: true,
  },
});

const currentMonthName = ref("");
currentMonthName.value = selectedDate.value.month;

const currentMonth = ref("");

//event listener for chosen month
function getMonth(m) {
  currentMonthName.value=m.month.toLowerCase();
  currentMonth.value = m.monthNb
  selectedDate.value.month = m;
}

const emit = defineEmits(["getMonth"]);

const monthTab = [
  {
    month: "Février",
    monthNb: "02",
  },
  {
    month: "Mars",
    monthNb: "03",
  },
  {
    month: "Avril",
    monthNb: "04",
  },
  {
    month: "Mai",
    monthNb: "05",
  },
  {
    month: "Juin",
    monthNb: "06",
  },
  {
    month: "Juillet",
    monthNb: "07",
  },
  {
    month: "Août",
    monthNb: "08",
  },
  {
    month: "Septembre",
    monthNb: "09",
  },
];


</script>


<template>
  <div id="month-selected">
    <select class="dropdown" v-model="selected">
      <option
        v-for="month in monthTab"
        :key="month"
        v-bind:value="month"
        @click="$emit(getMonth, month)"
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
  justify-content: flex-end;
}
.dropdown{
  color: var(--orange);
  background-color:var(--white) ;
  border: none;
}
</style>
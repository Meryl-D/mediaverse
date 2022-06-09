<script setup>
import { chunkArrayInGroups } from "../../stores.js";
import { ref } from "vue";

const props = defineProps({
  days: {
    type: Object,
    required: true,
  },
  today: {
    type: String,
    required: true,
  },
});

let currentDate = "";
props.days.forEach((d) => {
  if (d.fullDate == props.today) {
    currentDate =
      d.dayLong + ", " + d.date + " " + d.month.toLowerCase() + " " + d.year;
  }
});

const weeksSchedule = chunkArrayInGroups(props.days, 7);
console.log(weeksSchedule);
</script>

<template>
  <div id="file">
    <div id="header">
      <div v-for="group in weeksSchedule" :key="group" id="week">
        <div v-for="day in group" :key="day.id" class="day">
          <p>{{ day.dayShort }}</p>
          <p>
            <strong>{{ day.date }}</strong>
          </p>
        </div>
      </div>
      <p class="choosenDay">
        <strong>{{ currentDate }}</strong>
      </p>
    </div>
    <hr />
  </div>
</template>


<style scoped>
#file {
  display: flex;
  flex-direction: column;
}
#week {
  display: flex;
  flex-direction: row;
}
.day {
  margin: 2%;
}
.choosenDay {
  text-align: center;
}
hr {
  color: var(--orange);
}
</style>
<script setup>
import { chunkArrayInGroups, selectedDate } from "../../stores.js";
import { watchEffect, ref, onMounted } from "vue";
import BaseCourse from "./BaseCourse.vue";
import TheTasks from "./TheTasks.vue";
import BaseGrille from "./BaseGrille.vue";

//-------------------------------------------------------------------------------------------------

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

//-------------------------------------------------------------------------------------------------

//reactive variable for the selected day with the date of the day
const currentDate = ref("");
const courseToShow = ref(Object);

props.days.forEach((d) => {
  if (d.fullDate == selectedDate.value.fullDate) {
    currentDate.value =
      d.dayLong + ", " + d.date + " " + d.month.toLowerCase() + " " + d.year;
    courseToShow.value = d;
  }
});

//event listener for day choose
function getDay(d) {
  currentDate.value =
    d.dayLong + ", " + d.date + " " + d.month.toLowerCase() + " " + d.year;
  courseToShow.value = d;
  selectedDate.value = d;
}

//-------------------------------------------------------------------------------------------------

//put 7 days together
const weeksSchedule = chunkArrayInGroups(props.days, 7);
let selectedWeekIndex = 0;

// Get the index of the week containing the selected day
for (let i = 0; i < weeksSchedule.length; i++) {
  if (
    weeksSchedule[i].some((day) => day.fullDate == selectedDate.value.fullDate)
  )
    selectedWeekIndex = i;
}

// scroll to current week once the app is mounted
onMounted(() => {
  const selectedWeek = document.getElementsByClassName("selected-week")[0];
  selectedWeek.scrollIntoView();
});

function isSelectedDate(day) {
  return day.fullDate == selectedDate.value.fullDate ? true : false;
}
</script>

<template>
  <div id="file">
    <div id="calendar">
      <div
        v-for="(group, index) in weeksSchedule"
        :key="group"
        class="week"
        :class="{ 'selected-week': index == selectedWeekIndex }"
      >
        <div
          v-for="day in group"
          :key="day"
          class="day"
          :class="{ 'selected-day': isSelectedDate(day) }"
          @click="getDay(day)"
        >
          <p>{{ day.dayShort }}</p>
          <p>
            <strong>{{ day.date }}</strong>
          </p>
        </div>
      </div>
    </div>
    <div>
      <p class="choosenDay bold">
        {{ currentDate }}
      </p>
    </div>
    <div id="separate">
      <hr />
    </div>
    <the-tasks :day="courseToShow"></the-tasks>
    <base-course :lessonDay="courseToShow"> </base-course>
    <base-grille :day="courseToShow"></base-grille>
  </div>
</template>


<style scoped>
#calendar {
  display: flex;
  flex-flow: row nowrap;
  height: 10vh;
  width: 100%;
  overflow: auto;
  -ms-overflow-style: none; /* for Internet Explorer, Edge */
  scrollbar-width: none; /* for Firefox */
  scroll-snap-type: x mandatory;
}

#calendar::-webkit-scrollbar {
  display: none; /* for Chrome, Safari, and Opera */
}

.week {
  display: flex;
  width: 100%;
  flex: none;
  scroll-snap-align: start;
}

.day {
  flex: 1;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  /* height: 80%; */
  /* margin-right: 3%;
  margin-left: 3%;
  margin-top: 1%; */
  cursor: pointer;
}
.select {
  color: var(--orange);
}
.choosenDay {
  text-align: center;
  margin: 0.6rem 0;
}
#separate {
  display: grid;
  margin-left: 6.5%;
  margin-right: 5%;
}
hr {
  height: 0;
  border: none;
  border-top: 2px solid var(--orange);
  background-color: transparent;
}

.selected-day p {
  color: var(--orange);
}
</style>
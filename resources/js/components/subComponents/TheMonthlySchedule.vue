
<script setup>
import BaseCourse from "./BaseCourse.vue";
import TheHeaderMobile from "./TheHeaderMobile.vue";
import TheTasks from "./TheTasks.vue";
import {
  chunkArrayInGroups,
  chunkArrayInMonth,
  selectedDate,
} from "../../stores.js";
import { watchEffect, ref, onMounted } from "vue";

const props = defineProps({
  schedule: {
    type: Object,
    required: true,
  },
  days: {
    type: Object,
    required: true,
  },
  today: {
    type: String,
    required: true,
  },
  daysInMonth: {
    type: String,
    required: true,
  },
  nextMonth: {
    type: String,
    required: true,
  },
});

//-------------------------------------------------------------------------------------------------
// get current day
const currentDate = ref("");
const courseToShow = ref(Object);

props.days.forEach((d) => {
  if (d.fullDate == selectedDate.value.fullDate) {
    currentDate.value =
      d.dayLong + ", " + d.date + " " + d.month.toLowerCase() + " " + d.year;
    courseToShow.value = d;
  }
});

function isSelectedDate(day) {
  return day.fullDate == selectedDate.value.fullDate ? true : false;
}

//event listener for day choose
function getDay(d) {
  currentDate.value =
    d.dayLong + ", " + d.date + " " + d.month.toLowerCase() + " " + d.year;
  courseToShow.value = d;
  selectedDate.value = d;
}

// get current month
//const currentMonth = ref(selectedDate.value.monthNb);
const currentMonth = ref("06");

//-------------------------------------------------------------------------------------------------

//group days by month

let monthlySchedule = [];
props.days.forEach((d) => {
  if (currentMonth.value == d.monthNb) {
    monthlySchedule.push(d);
  }
});

//if beginning of the month isn't a monday
const firstDay = monthlySchedule[0];
if (firstDay.dayShort == "Ma") {
  monthlySchedule.unshift("Lu");
}
if (firstDay.dayShort == "Me") {
  monthlySchedule.unshift("Lu", "Ma");
}
if (firstDay.dayShort == "Je") {
  monthlySchedule.unshift("Lu", "Ma", "Me");
}
if (firstDay.dayShort == "Ve") {
  monthlySchedule.unshift("Lu", "Ma", "Me", "Je");
}
if (firstDay.dayShort == "Sa") {
  monthlySchedule.unshift("Lu", "Ma", "Me", "Je", "Ve");
}
if (firstDay.dayShort == "Di") {
  monthlySchedule.unshift("Lu", "Ma", "Me", "Je", "Ve", "Sa");
}
console.log(monthlySchedule);
</script>


<template>
  <div id="MonthlyCalendar">
    <div class="month">
      <div class="daysOfWeek">
        <div class="days"><p>Lu</p></div>
        <div v-for="day in monthlySchedule">
          <div v-if="day == 'Lu'">
            <p>
              <strong>-</strong>
            </p>
          </div>
        </div>
        <div
          v-for="day in monthlySchedule"
          :key="day"
          :class="{ 'selected-day': isSelectedDate(day) }"
          @click="getDay(day)"
        >
          <div v-if="day.dayShort == 'Lu'">
            <p>
              <strong>{{ day.date }}</strong>
            </p>
          </div>
        </div>
      </div>

      <div class="daysOfWeek">
        <p class="days">Ma</p>
        <div v-for="day in monthlySchedule">
          <div v-if="day == 'Ma'">
            <p>
              <strong>-</strong>
            </p>
          </div>
        </div>
        <div
          v-for="day in monthlySchedule"
          :key="day"
          :class="{ 'selected-day': isSelectedDate(day) }"
          @click="getDay(day)"
        >
          <div v-if="day.dayShort == 'Ma'">
            <p>
              <strong>{{ day.date }}</strong>
            </p>
          </div>
        </div>
      </div>

      <div class="daysOfWeek">
        <p class="days">Me</p>
        <div v-for="day in monthlySchedule">
          <div v-if="day == 'Me'">
            <p>
              <strong>-</strong>
            </p>
          </div>
        </div>
        <div
          v-for="day in monthlySchedule"
          :key="day"
          :class="{ 'selected-day': isSelectedDate(day) }"
          @click="getDay(day)"
        >
          <div v-if="day.dayShort == 'Me'">
            <p>
              <strong>{{ day.date }}</strong>
            </p>
          </div>
        </div>
      </div>

      <div class="daysOfWeek">
        <p class="days">Je</p>
        <div v-for="day in monthlySchedule">
          <div v-if="day == 'Je'">
            <p>
              <strong>-</strong>
            </p>
          </div>
        </div>
        <div
          v-for="day in monthlySchedule"
          :key="day"
          :class="{ 'selected-day': isSelectedDate(day) }"
          @click="getDay(day)"
        >
          <div v-if="day.dayShort == 'Je'">
            <p>
              <strong>{{ day.date }}</strong>
            </p>
          </div>
        </div>
      </div>

      <div class="daysOfWeek">
        <p class="days">Ve</p>
        <div v-for="day in monthlySchedule">
          <div v-if="day == 'Ve'">
            <p>
              <strong>-</strong>
            </p>
          </div>
        </div>
        <div
          v-for="day in monthlySchedule"
          :key="day"
          :class="{ 'selected-day': isSelectedDate(day) }"
          @click="getDay(day)"
        >
          <div v-if="day.dayShort == 'Ve'">
            <p>
              <strong>{{ day.date }}</strong>
            </p>
          </div>
        </div>
      </div>

      <div class="daysOfWeek">
        <p class="days">Sa</p>
        <div v-for="day in monthlySchedule">
          <div v-if="day == 'Sa'">
            <p>
              <strong>-</strong>
            </p>
          </div>
        </div>
        <div
          v-for="day in monthlySchedule"
          :key="day"
          :class="{ 'selected-day': isSelectedDate(day) }"
          @click="getDay(day)"
        >
          <div v-if="day.dayShort == 'Sa'">
            <p>
              <strong>{{ day.date }}</strong>
            </p>
          </div>
        </div>
      </div>

      <div class="daysOfWeek">
        <p class="days">Di</p>
        <div v-for="day in monthlySchedule">
          <div v-if="day == 'Di'">
            <p>
              <strong>-</strong>
            </p>
          </div>
        </div>
        <div
          v-for="day in monthlySchedule"
          :key="day"
          :class="{ 'selected-day': isSelectedDate(day) }"
          @click="getDay(day)"
        >
          <div v-if="day.dayShort == 'Di'">
            <p>
              <strong>{{ day.date }}</strong>
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="course month">
      <p classe="choosenDay p bold">{{ currentDate }}</p>
      <div class="course">
        <div>
          <p>{{ courseToShow.timeStart }}</p>
          <p>{{ courseToShow.timeEnd }}</p>
        </div>
        <base-course :lessonDay="courseToShow"></base-course>
      </div>
    </div>
    <hr />
  </div>
</template>

<style scoped>
#MonthlyCalendar {
  background-color: var(--white);
  align-content: center;
  justify-content: center;
}
.month {
  display: flex;
  align-content: center;
  justify-content: center;
}
.daysOfWeek {
  border-bottom: 1em var(--orange);
  text-align: center;
  margin: 1rem;
  align-content: center;
}
.course {
  flex-direction: column;
  flex-wrap: wrap;
}
.choosenDay {
  padding-left: 1rem;
}
.selected-day p {
  color: var(--orange);
}
.days {
  border-bottom: 1em var(--orange);
}
</style>
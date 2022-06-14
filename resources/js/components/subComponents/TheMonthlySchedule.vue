
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
import {BaseDropdown} from "./BaseDropdown.vue";

const props = defineProps({
  schedule: {
    type: Object,
    required: true,
  },
  days: {
    type: Object,
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
</script>


<template>
  <div id="MonthlyCalendar">
    <base-dropdown :schedule="props.schedule"></base-dropdown>
    <section class="calendar">
      <div class="daysOfWeek">
        <p>Lu</p><hr class="lineOrange" />
        <div v-for="day in monthlySchedule">
          <div v-if="day == 'Lu'">
            <p class="day">
              <strong>-</strong>
            </p>
            <hr class="lineSpace" />
          </div>
        </div>
        <div
          v-for="day in monthlySchedule"
          :key="day"
          :class="{ 'selected-day': isSelectedDate(day) }"
          @click="getDay(day)"
        >
          <div v-if="day.dayShort == 'Lu'">
            <p class="day">
              <strong>{{ day.date }}</strong>
            </p>
            <hr class="lineSpace" />
          </div>
        </div>
      </div>

      <div class="daysOfWeek">
        <p>Ma</p><hr class="lineOrange" />
        <div v-for="day in monthlySchedule">
          <div v-if="day == 'Ma'">
            <p class="day">
              <strong>-</strong>
            </p>
            <hr class="lineSpace" />
          </div>
        </div>
        <div
          v-for="day in monthlySchedule"
          :key="day"
          :class="{ 'selected-day': isSelectedDate(day) }"
          @click="getDay(day)"
        >
          <div v-if="day.dayShort == 'Ma'">
            <p class="day">
              <strong>{{ day.date }}</strong>
            </p>
            <hr class="lineSpace" />
          </div>
        </div>
      </div>

      <div class="daysOfWeek">
        <p>Me</p><hr class="lineOrange" />
        <div v-for="day in monthlySchedule">
          <div v-if="day == 'Me'">
            <p class="day">
              <strong>-</strong>
            </p>
            <hr class="lineSpace" />
          </div>
        </div>
        <div
          v-for="day in monthlySchedule"
          :key="day"
          :class="{ 'selected-day': isSelectedDate(day) }"
          @click="getDay(day)"
        >
          <div v-if="day.dayShort == 'Me'">
            <p class="day">
              <strong>{{ day.date }}</strong>
            </p>
            <hr class="lineSpace" />
          </div>
        </div>
      </div>

      <div class="daysOfWeek">
        <p>Je</p><hr class="lineOrange" />
        <div v-for="day in monthlySchedule">
          <div v-if="day == 'Je'">
            <p class="day">
              <strong>-</strong>
            </p>
            <hr class="lineSpace" />
          </div>
        </div>
        <div
          v-for="day in monthlySchedule"
          :key="day"
          :class="{ 'selected-day': isSelectedDate(day) }"
          @click="getDay(day)"
        >
          <div v-if="day.dayShort == 'Je'">
            <p class="day">
              <strong>{{ day.date }}</strong>
            </p>
            <hr class="lineSpace" />
          </div>
        </div>
      </div>

      <div class="daysOfWeek">
        <p>Ve</p><hr class="lineOrange" />
        <div v-for="day in monthlySchedule">
          <div v-if="day == 'Ve'">
            <p class="day">
              <strong>-</strong>
            </p>
            <hr class="lineSpace" />
          </div>
        </div>
        <div
          v-for="day in monthlySchedule"
          :key="day"
          :class="{ 'selected-day': isSelectedDate(day) }"
          @click="getDay(day)"
        >
          <div v-if="day.dayShort == 'Ve'">
            <p class="day">
              <strong>{{ day.date }}</strong>
            </p>
            <hr class="lineSpace" />
          </div>
        </div>
      </div>

      <div class="daysOfWeek">
        <p>Sa</p><hr class="lineOrange" />
        <div v-for="day in monthlySchedule">
          <div v-if="day == 'Sa'">
            <p class="day">
              <strong>-</strong>
            </p>
            <hr class="lineSpace" />
          </div>
        </div>
        <div
          v-for="day in monthlySchedule"
          :key="day"
          :class="{ 'selected-day': isSelectedDate(day) }"
          @click="getDay(day)"
        >
          <div v-if="day.dayShort == 'Sa'">
            <p class="day">
              <strong>{{ day.date }}</strong>
            </p>
            <hr class="lineSpace" />
          </div>
        </div>
      </div>

      <div class="daysOfWeek">
        <p>Di</p><hr class="lineOrange" />
        <div v-for="day in monthlySchedule">
          <div v-if="day == 'Di'">
            <p class="day">
              <strong>-</strong>
            </p>
            <hr class="lineSpace" />
          </div>
        </div>
        <div
          v-for="day in monthlySchedule"
          :key="day"
          :class="{ 'selected-day': isSelectedDate(day) }"
          @click="getDay(day)"
        >
          <div v-if="day.dayShort == 'Di'">
            <p class="day">
              <strong>{{ day.date }}</strong>
            </p>
            <hr class="lineSpace" />
          </div>
        </div>
      </div>
    </section>

    <div class="agenda">
      <div class="chosenDay p bold">
        <p>{{ currentDate }}</p>
      </div>
      <div>
        <div>
          <p>{{ courseToShow.timeStart }}</p>
          <p>{{ courseToShow.timeEnd }}</p>
        </div>
        <base-course :lessonDay="courseToShow" class="course"></base-course>
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
h1{
  display: flex;
  align-content: center;
  justify-content: center;
}
.calendar {
  display: flex;
  align-content: center;
  justify-content: center;
}
.daysOfWeek {
  /* border-bottom: 1em var(--orange); */
  text-align: center;
  /* margin: 1rem; */
  align-content: center;
}
.agenda {
  display: flex;
  flex-wrap: wrap;
}
.course {
  flex-direction: column;
  flex-wrap: wrap;
}
.chosenDay {
  margin-top: 1rem;
  padding-left: 1rem;
  flex-basis: 100%;
}
.selected-day p {
  color: var(--orange);
}

.day {
  margin: 1rem;
}
.lineSpace {
  margin: 0;
  height: 0;
  border-top: 1px solid var(--green);
}
.lineOrange{
  margin: 0;
  height: 0;
  border-top: 2px solid var(--orange);
}
.time {
  height: 500px;
}
</style>

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
import BaseDropdown from "./BaseDropdown.vue";
import BaseBackButton from "./BaseBackButton.vue";
import switchViewButton from "./switchViewButton.vue";

const props = defineProps({
  schedule: {
    type: Object,
    required: true,
  },
  days: {
    type: Object,
    required: true,
  },
  tasks: {
    type: Object,
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

//event listener for chosen day
function getDay(d) {
  currentDate.value =
    d.dayLong + ", " + d.date + " " + d.month.toLowerCase() + " " + d.year;
  courseToShow.value = d;
  selectedDate.value = d;
}

// get current month
const currentMonth = ref(selectedDate.value.monthNb);

//-------------------------------------------------------------------------------------------------

//group days by month
const monthlySchedule = [];
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
console.log(courseToShow);
const CourseTab = courseToShow.value.courses;
CourseTab.forEach(e => {
  console.log(e)
});
console.log(CourseTab);
</script>


<template>
  <div id="MonthlyCalendar">
    <section>
      <base-back-button></base-back-button>
      <switch-view-button :lessonDay="courseToShow"></switch-view-button>
    </section>
    <section class="calendar">
      <div class="daysOfWeek">
        <p>Lu</p>
        <hr class="lineOrange" />
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
        <p>Ma</p>
        <hr class="lineOrange" />
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
        <p>Me</p>
        <hr class="lineOrange" />
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
        <p>Je</p>
        <hr class="lineOrange" />
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
        <p>Ve</p>
        <hr class="lineOrange" />
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
        <p>Sa</p>
        <hr class="lineOrange" />
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
        <p>Di</p>
        <hr class="lineOrange" />
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

    <hr />
    <section class="agenda">
      <div class="chosenDay p bold">
        <p>{{ currentDate }}</p>
      </div>
      <div>
        <!-- <div v-for="course in CourseTab" :key="course">
          <p>{{ course.timeStart }}</p>
          <p>{{ course.timeEnd }}</p>
        </div> -->
        <div class="maxWidth">
          <div v-for="course in CourseTab" :key="course" class="courseTC">
            <div class="timeStartEnd">
              <p>{{ course.timeStart }}</p>
              <p>{{ course.timeEnd }}</p>
            </div>
            <base-course :lesson="course" class="course"></base-course>
          </div>
        </div>
      </div>
      <hr />
    </section>
  </div>
</template>

<style scoped>
#MonthlyCalendar {
  background-color: var(--white);
  align-content: center;
  justify-content: center;
}
h1 {
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
  flex-basis: 100%;
}
.chosenDay {
  margin-top: 1rem;
  padding-left: 1rem;
  flex-basis: 100%;
  margin-bottom: 0;
}
.selected-day p {
  color: var(--orange);
}

.day {
  margin: 1rem;
}
.lineSpace {
  margin: 0;
  border-top: 0.1rem solid var(--green);
}
.lineOrange {
  margin: 0;
  border-top: 0.2rem solid var(--orange);
}
.time {
  height: 500px;
}
.maxWidth {
  flex-basis: 100%;
}
</style>
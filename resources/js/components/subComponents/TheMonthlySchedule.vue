
<script setup>
import BaseCourseTime from "./BaseCourseTime.vue";
import TheHeaderMobile from "./TheHeaderMobile.vue";
import TheTasks from "./TheTasks.vue";
import {
  chunkArrayInGroups,
  chunkArrayInMonth,
  selectedDate,
  selectedTasks,
  isMobile,
} from "../../stores.js";
import { watchEffect, ref, onMounted } from "vue";
import BaseDropdown from "./BaseDropdown.vue";
import BaseBackButton from "./BaseBackButton.vue";
import SwitchViewButton from "./SwitchViewButton.vue";

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
// get tasks
selectedTasks.value = [];

props.tasks.forEach((task) => {
  if (task.dateStart.substr(0, 10) == selectedDate.value.fullDate) {
    selectedTasks.value.push(task);
  }
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

// get tasks
  selectedTasks.value = [];
  props.tasks.forEach((task) => {
    if (task.dateStart.substr(0, 10) == selectedDate.value.fullDate) {
      selectedTasks.value.push(task);
    }
  });
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

const CourseTab = courseToShow.value.courses;

const monthToShow = ref(courseToShow.value.month);
const yearToShow = ref(courseToShow.value.year);

//-------------------------------------------------------------------------------------------------

// marks for task and courses under each day
function checkCourse(d) {
  return d.courses ? true : false;
}

function checkTask(d) {
  const hasTask = props.tasks.some(
    (task) =>
      task.dateStart.substr(0, 10) == d.fullDate ||
      task.dateEnd.substr(0, 10) == d.fullDate
  );
  return hasTask;
}
</script>


<template>
  <div id="MonthlyCalendar">
    <div v-if="!isMobile" class="titleDesktop">
      <div class="navMonth">
        <base-back-button></base-back-button>
        <div class="flexTitle">
          <h1>{{ monthToShow }} {{ yearToShow }}</h1>
          <switch-view-button
            ><span class="material-icons icalendar"
              >calendar_today</span
            ></switch-view-button
          >
        </div>
        <!-- <p class="pLink">Horaire</p>
        <p class="sLink">></p>
        <p class="pLink">{{ monthToShow }} {{ yearToShow }}</p> -->
      </div>
    </div>
    <div v-if="isMobile" class="titleMobile">
      <base-back-button></base-back-button>
      <switch-view-button>{{ monthToShow }}</switch-view-button>
    </div>
    <div class="bodyMonth">
      <div class="calendar">
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
              <div class="circles">
                <div v-if="checkTask(day)" class="task-circle-day"></div>
                <div v-if="checkCourse(day)" class="course-circle-day"></div>
              </div>
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
              <div class="circles">
                <div v-if="checkTask(day)" class="task-circle-day"></div>
                <div v-if="checkCourse(day)" class="course-circle-day"></div>
              </div>
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
              <div class="circles">
                <div v-if="checkTask(day)" class="task-circle-day"></div>
                <div v-if="checkCourse(day)" class="course-circle-day"></div>
              </div>
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
              <div class="circles">
                <div v-if="checkTask(day)" class="task-circle-day"></div>
                <div v-if="checkCourse(day)" class="course-circle-day"></div>
              </div>
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
              <div class="circles">
                <div v-if="checkTask(day)" class="task-circle-day"></div>
                <div v-if="checkCourse(day)" class="course-circle-day"></div>
              </div>
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
              <div class="circles">
                <div v-if="checkTask(day)" class="task-circle-day"></div>
                <div v-if="checkCourse(day)" class="course-circle-day"></div>
              </div>
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
              <div class="circles">
                <div v-if="checkTask(day)" class="task-circle-day"></div>
                <div v-if="checkCourse(day)" class="course-circle-day"></div>
              </div>
              <hr class="lineSpace" />
            </div>
          </div>
        </div>
      </div>

      <section>
        <div class="agenda">
          <div class="chosenDay p bold">
            <p>{{ currentDate }}</p>
            <hr v-if="!isMobile" class="lineSpace" />
          </div>
          <base-course-time
            :lessonDay="courseToShow"
            class="course"
          ></base-course-time>
          <the-tasks></the-tasks>
        </div>
      </section>
    </div>
  </div>
</template>

<style scoped>
#MonthlyCalendar {
  display: flex;
  flex-direction: column;
  background-color: var(--white);
  height: 100%;
  padding: 2.5rem 1rem 0 1rem;
  /* align-content: center;
  justify-content: center; */
}
.titleDesktop {
  width: 100%;
  margin-bottom: 2rem;
}
.pLink {
  display: inline;
  text-decoration: underline;
  text-underline-offset: 2px;
  opacity: 75%;
  cursor: pointer;
}
.sLink {
  display: inline;
  opacity: 75%;
  cursor: pointer;
}
.bodyMonth {
  display: grid;
  grid-template-columns: 55% 45%;
  /* flex-direction: row; */
  /* height: 100%; */
}

.nextMonth {
  height: 50px;
  width: 100%;
}

.calendar {
  display: flex;
  align-content: flex-start;
  justify-content: flex-start;
}
.daysOfWeek {
  /* border-bottom: 1em var(--orange); */
  text-align: center;
  margin: 1rem;
  align-content: center;
}
.agenda {
  display: flex;
  flex-direction: column;
  width: 100%;
  /* flex-wrap: wrap; */
}
.course {
  padding-right: 0.7rem;
}
/* .chosenDay {
  margin-top: 1rem;
  padding-left: 1rem;
  flex-basis: 100%;
  margin-bottom: 0;
} */
.selected-day p {
  color: var(--orange);
}

.day {
  margin: 1rem;
  cursor: pointer;
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
@media (max-width: 992px) {
  #MonthlyCalendar {
    padding: 0 1rem 0 1rem;
    height: 100vw;
  }
  .titleMobile {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    margin-bottom: 0.3rem;
  }
  .bodyMonth {
    display: flex;
    flex-direction: column;
  }
  .daysOfWeek {
    margin: 0;
  }
  .day {
    margin: 0.8rem 1rem 0.8rem 1rem;
    cursor: pointer;
  }
  .calendar {
    margin-bottom: 2rem;
    justify-content: center;
  }
  .course {
    width: auto;
    padding: 0;
    margin: 0 0 0.7rem 0;
  }
  .flexTitle {
    display: flex;
    /* flex-basis: 100%; */
    flex-direction: row;
    justify-content: space-between;
  }
}
.circles {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.task-circle-day {
  background-color: var(--brown);
  border-radius: 5rem;
  width: 0.7rem;
  height: 0.7rem;
  margin: 0 0.1rem 0.1rem 0.1rem;
}
.course-circle-day {
  width: 0.7rem;
  height: 0.7rem;
  margin: 0 0.1rem 0.1rem 0.1rem;
  background-color: var(--beige);
  border-radius: 5rem;
}
</style>
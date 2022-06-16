<script setup>
import {
  chunkArrayInGroups,
  selectedDate,
  selectedTasks,
  isMobile,
} from "../../stores.js";
import { watchEffect, ref, onMounted } from "vue";
import BaseCourse from "./BaseCourse.vue";
import TheTasks from "./TheTasks.vue";
import BaseGrid from "./BaseGrid.vue";
import TheAddTask from "./TheAddTask.vue";
import BaseBackButton from "./BaseBackButton.vue";
import SwitchViewButton from "./SwitchViewButton.vue";
import TheEditTask from "./TheEditTask.vue";

//-------------------------------------------------------------------------------------------------

const props = defineProps({
  days: {
    type: Object,
    required: true,
  },
  tasks: {
    type: Object,
  },
});

selectedTasks.value = [];

props.tasks.forEach((task) => {
  if (task.dateStart.substr(0, 10) == selectedDate.value.fullDate) {
    selectedTasks.value.push(task);
  }
});

//-------------------------------------------------------------------------------------------------

//reactive variable for the selected day with the date of the day
const currentDate = ref("");
const simpleCurrentDate = ref("");
const courseToShow = ref(Object);

props.days.forEach((d) => {
  if (d.fullDate == selectedDate.value.fullDate) {
    currentDate.value =
      d.dayLong + ", " + d.date + " " + d.month.toLowerCase() + " " + d.year;
    courseToShow.value = d;
    simpleCurrentDate.value =
      d.date + " " + d.month.toLowerCase() + " " + d.year;
  }
});

//event listener on the chosen day
function getDay(d) {
  currentDate.value =
    d.dayLong + ", " + d.date + " " + d.month.toLowerCase() + " " + d.year;
  courseToShow.value = d;
  selectedDate.value = d;
  simpleCurrentDate.value = d.date + " " + d.month.toLowerCase() + " " + d.year;

  // empty the selected tasks array
  selectedTasks.value = [];
  // add tasks of the selected day to selectedTasks array
  props.tasks.forEach((task) => {
    if (task.dateStart.substr(0, 10) == d.fullDate) {
      selectedTasks.value.push(task);
    }
  });
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
  selectedWeek.scrollIntoView({ block: "nearest", inline: "nearest" });
});

function isSelectedDate(day) {
  return day.fullDate == selectedDate.value.fullDate ? true : false;
}

//-------------------------------------------------------------------------------------
//add task on click
const popUp = ref(false);

function addTask() {
  popUp.value = true;
  document.getElementById("rect").classList.add("hidden");
  return popUp;
}
function closeTask() {
  popUp.value = false;
  document.getElementById("rect").classList.remove("hidden");
  return popUp;
}
//-------------------------------------------------------------------------------------

const editPopUp = ref(false);

const toEditTask = ref("");
function popUpEdit(task) {
  editPopUp.value = true;
  toEditTask.value = task;
  document.getElementById("rect").classList.add("hidden");
  return editPopUp;
}

function closeEditTask() {
  editPopUp.value = false;
  document.getElementById("rect").classList.remove("hidden");
  return editPopUp;
}

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

const monthToShow = ref(courseToShow.value.month);
const yearToShow = ref(courseToShow.value.year);
</script>

<template>
  <div id="rect"></div>
  <div id="container">
    <div v-if="popUp" class="ctn-popUp">
      <the-add-task
        @close="closeTask"
        class="popUp"
        @add="closeTask"
      ></the-add-task>
    </div>
  </div>
  <div id="container">
    <div v-if="editPopUp" class="ctn-editPopUp">
      <the-edit-task
        @close="closeEditTask"
        class="popUpEdit"
        @add="closeEditTask"
        :task="toEditTask"
      ></the-edit-task>
    </div>
  </div>
  <div id="file">
    <div v-if="!isMobile" class="daily-nav">
      <div class="mainTitle">
        <base-back-button></base-back-button>
        <div>
          <h1>{{ monthToShow }} {{ yearToShow }}</h1>
        </div>
        <!-- <div class="navMonth">
          <p class="pLink">Horaire</p>
          <p class="sLink">></p>
          <p class="pLink">{{ monthToShow }} {{ yearToShow }}</p>
          <p class="sLink">></p>
          <p class="pLink">{{ simpleCurrentDate }}</p>
        </div> -->
      </div>
      <div class="mainIcone">
        <div class="icone">
          <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"
          />
          <span class="material-icons" @click="addTask()">add_circle</span>
        </div>
        <switch-view-button
          ><span class="material-icons icalendar"
            >calendar_today</span
          ></switch-view-button
        >
      </div>
    </div>
    <div v-if="isMobile" class="titleMobileDay">
      <base-back-button></base-back-button>
      <switch-view-button>{{ monthToShow }}</switch-view-button>
    </div>
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
          <p class="dDay">
            {{ day.date }}
          </p>
          <div class="circles">
            <div v-if="checkTask(day)" class="task-circle-day"></div>
            <div v-if="checkCourse(day)" class="course-circle-day"></div>
          </div>
        </div>
      </div>
    </div>
    <div>
      <p class="choosenDay bold">
        {{ currentDate }}
      </p>
    </div>
    <!-- <div id="separate">
      <hr />
    </div> -->
    <div class="grid-container">
      <base-grid :courseToShow="courseToShow" @editTask="popUpEdit"></base-grid>
    </div>
    <!-- <div class="grid"> -->
    <!-- <div class="course">
      <h1>Cours</h1>
      <base-course :lessonDay="courseToShow"> </base-course>
    </div> -->
    <!-- <div class="task">
        <h1>Tâches</h1>
        <the-tasks :day="courseToShow"></the-tasks> -->

    <div v-if="isMobile" class="icone">
      <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"
      />
      <span class="material-icons" @click="addTask()">add_circle</span>
    </div>
  </div>
</template>


<style scoped>
.hidden {
  position: absolute;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: black;
  opacity: 50%;
  z-index: 50;
}
#file {
  display: flex;
  flex-direction: column;
  align-items: center;
}
/* .daily-nav {
  display: flex;
  flex-direction: row;
} */
.daily-nav {
  display: flex;
  justify-content: space-between;
  width: 90%;
  padding: 2rem 0;
  align-items: center;
}
.mainTitle {
  display: flex;
  flex-direction: column;
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
.mainIcone {
  display: flex;
  flex-direction: row;
}
.icalendar {
  margin-left: 0.5rem;
}
.circles {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.task-circle-day {
  background-color: var(--brown);
  width: 0.7rem;
  height: 0.7rem;
  margin: 0 0.1rem 0.1rem 0.1rem;
  border-radius: 5rem;
}
.course-circle-day {
  width: 0.7rem;
  height: 0.7rem;
  margin: 0 0.1rem 0.1rem 0.1rem;
  background-color: var(--beige);
  border-radius: 5rem;
}

#calendar {
  display: flex;
  flex-flow: row nowrap;
  height: 12vh;
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
.dDay {
  font-size: 1rem;
  font-weight: 900;
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
  z-index: 0;
}
.selected-day p {
  color: var(--orange);
}
.icone {
  display: flex;
  justify-content: right;
  width: 100%;
  padding-right: 3%;
  /* display: inline-block; */
  text-align: right;
}
.material-icons {
  color: var(--orange);
  filter: drop-shadow(0 0 0.75rem var(--orange));
  cursor: pointer;
}
.popUp {
  width: 100%;
}
.popUpEdit {
  width: 100%;
}
#container {
  display: flex;
  position: absolute;
  width: 100%;
  justify-content: center;
  z-index: 100;
}
.ctn-popUp {
  flex-basis: 90%;
}
.ctn-editPopUp {
  flex-basis: 90%;
}

.grid-container {
  width: 90%;
  height: 60vh;
  -ms-overflow-style: none; /* for Internet Explorer, Edge */
  scrollbar-width: none; /* for Firefox */
  overflow-y: scroll;
  scroll-snap-type: y mandatory;
}

.grid-container::-webkit-scrollbar {
  display: none; /* for Chrome, Safari, and Opera */
}

@media (max-width: 992px) {
  #rect {
    width: 75%;
  }
  /* #container {
      width: 100%;
    } */

  .titleMobileDay {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    margin: 0 0 0.3rem 0;
    width: 100%;
    padding: 0 1rem 1rem 1rem;
  }
  #calendar {
    height: 14vh;
  }
  .grid-container {
    width: 90%;
    height: 60vh;
  }
  .icone {
    display: flex;
    justify-content: right;
    width: 100%;
    padding-right: 3%;
    /* display: inline-block; */
    text-align: right;
  }
  .choosenDay {
    text-align: center;
    margin: 0.5rem 0 0 0;
  }
}
</style>
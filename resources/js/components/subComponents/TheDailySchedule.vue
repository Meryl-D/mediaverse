<script setup>
import { chunkArrayInGroups, selectedDate, selectedTasks, isMobile } from "../../stores.js";
import { watchEffect, ref, onMounted } from "vue";
import BaseCourse from "./BaseCourse.vue";
import TheTasks from "./TheTasks.vue";
import BaseGrid from "./BaseGrid.vue";
import TheAddTask from "./TheAddTask.vue";
import BaseBackButton from "./BaseBackButton.vue";
import switchViewButton from "./switchViewButton.vue";
import TheEditTask from './TheEditTask.vue';

//-------------------------------------------------------------------------------------------------

//console.log(isMobile.value)

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
const courseToShow = ref(Object);

props.days.forEach((d) => {
  if (d.fullDate == selectedDate.value.fullDate) {
    currentDate.value =
      d.dayLong + ", " + d.date + " " + d.month.toLowerCase() + " " + d.year;
    courseToShow.value = d;
  }
});

//event listener on the chosen day
function getDay(d) {
  currentDate.value =
    d.dayLong + ", " + d.date + " " + d.month.toLowerCase() + " " + d.year;
  courseToShow.value = d;
  selectedDate.value = d;

  // empty the selected tasks array
  selectedTasks.value = [];
  // add tasks of the selected day to selectedTasks array
  props.tasks.forEach((task) => {
    if (task.dateStart.substr(0, 10) == d.fullDate) {
      selectedTasks.value.push(task);
    }
  });
  //console.log(selectedTasks.value)
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

const editPopUp = ref(false)

const toEditTask = ref("") 
function popUpEdit(task){
  editPopUp.value = true;
  toEditTask.value = task
  document.getElementById("rect").classList.add("hidden")
  return editPopUp
}

function closeEditTask() {
  editPopUp.value = false;
  document.getElementById("rect").classList.remove("hidden");
  return editPopUp
}


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
        :task = "toEditTask"
      ></the-edit-task>
    </div>
  </div>
  <div id="file">
    <section class="daily-nav">
      <base-back-button></base-back-button>
      <switch-view-button :lessonDay="courseToShow"></switch-view-button>
    </section>
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
    <div class="grid-container">
        <base-grid :courseToShow="courseToShow" @editTask="popUpEdit"></base-grid>
    </div>
    <!-- <div class="grid">
      <div class="course">
        <h1>Cours</h1>
        <base-course :lessonDay="courseToShow"> </base-course>
      </div>
      <div class="task">
        <h1>Tâches</h1>
        <the-tasks :day="courseToShow"></the-tasks> -->

    <div class="icone">
      <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"
      />
      <span class="material-icons" @click="addTask()">add_circle</span>
    </div>
    <!-- </div>
    </div> -->
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
  z-index: 0;
}
.selected-day p {
  color: var(--orange);
}

h1 {
  margin-left: 1rem;
}
.icone {
  margin: 3%;
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
.ctn-editPopUp{
  flex-basis: 90%;
}

.grid-container {
  width: 90%;
  height: 50vh;
  -ms-overflow-style: none; /* for Internet Explorer, Edge */
  scrollbar-width: none; /* for Firefox */
  overflow-y: scroll;
  scroll-snap-type: y mandatory;
}

.grid-container::-webkit-scrollbar {
  display: none; /* for Chrome, Safari, and Opera */
}

@media(min-width: 992px){
  #rect {
    width: 75%;
  }

  #container {
    width: 75%;
  }

  .daily-nav {
    display: flex;
    justify-content: space-between;
    width: 90%;
    padding: 2rem 0;
    align-items: center;
  }
}
</style>
<script setup>
import BaseCourse from "./BaseCourse.vue";
import TheTasks from "./TheTasks.vue";
import { ref, onMounted } from "vue";
import { watchEffect } from "vue";
import { selectedTasks, selectedDate, tasksTmpl } from "../../stores.js";

const props = defineProps({
  courseToShow: {
    type: Object,
    required: true,
  }
});

const tasksOfDay = ref();
const gridHours = ref([]);
const gridLines = ref([])

onMounted(() => {

  watchEffect(() => {
      props.courseToShow

      const tasks = tasksOfDay.value.taskRefs;

      for (let i = 0; i < gridLines.value.length; i++) {
        gridLines.value[i].style.gridRowStart = i + 1
      }

      if (tasks.length) {
        for (let i = 0; i < tasks.length; i++) {
          const taskHourStart = selectedTasks.value[i].hourStart
          const taskHourEnd = selectedTasks.value[i].hourEnd
          console.log(taskHourEnd)
          tasks[i].style.gridRowStart = parseInt(taskHourStart) + 1
          tasks[i].style.gridRowEnd = parseInt(taskHourEnd) + 1
        }
      }
  })
});
</script>

<template>
  <div class="grid">
    <div v-for="n in 25" :key="n" class="grid-hours" ref="gridHours">
      <p v-if="n - 1 < 10" class="hour">0{{ n - 1 }}:00</p>
      <p v-if="n - 1 >= 10" class="hour">{{ n - 1 }}:00</p>
    </div>
    <div v-for="n in 25" :key="n" class="grid-lines" ref="gridLines">
      <hr v-if="n - 1 < 10" :class="`grid-hr-0${n - 1}`"/>
      <hr v-if="n - 1 >= 10" :class="`grid-hr-${n - 1}`"/>
    </div>
    <the-tasks ref="tasksOfDay" @editTask="$emit('editTask', $event)"></the-tasks>
    <!-- <base-course :lessonDay="selectedDate"> </base-course> -->
  </div>
</template>

<style scoped>
.grid {
  display: grid;
  grid-template-columns: 5rem auto;
  margin-top: 1rem;
  position: relative;

}

.grid-hours {
  grid-column-start: 1;
  display: flex;
  align-items: center;
}

.grid-lines {
  grid-column-start: 2;
  height: 2rem;


}

.hour {
  margin: 0;
  transform: translateY(-1rem);
}

/* .grid-hours-ctn {
    flex: 1;
}

.grid-lines-ctn {
  display: grid;
  grid-template-rows: repeat(24, 1fr);
  flex: 10;
} */

.s {
  display: flex;
  align-items: center;
  justify-content: flex-start;
}

hr {
  margin: 0;
  color: gray;
  height: 0;
  border: none;
  border-top: 2px solid gray;
  background-color: transparent;
}
</style>
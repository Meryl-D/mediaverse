<script async setup>
import { ref, computed, watchEffect, onMounted } from "vue";
import { axiosClient } from "../../utils/axios.js";
import BaseButton from "../../components/subComponents/BaseButton.vue";
import BaseBox from "../../components/subComponents/BaseBox.vue";
import { selectedTasks, tasksTmpl, isMobile, formatHourForGrid, isActive } from "../../stores.js";

// function getTask(d){
//   if( d.dateStart.substr(0,10) == props.day.fullDate){
//     return true
//   }
//   return false
// }
const emit = defineEmits(["editTask"])

const gridSelectedTasks = computed(() => {
  const tasks = []
  selectedTasks.value.forEach(task => {
    tasks.push(
      {
      gridRowStart: formatHourForGrid(task.hourStart),
      gridRowEnd: formatHourForGrid(task.hourEnd)
    }
    )
  });
  return tasks
})

const timeTasks = computed(() => {
  const tasks = []
  selectedTasks.value.forEach(task => {
    tasks.push(
      {
      timeStart: task.dateStart.substring(11, 16),
      timeEnd: task.dateEnd.substring(11, 16)
    }
    )
  });
  return tasks
})

console.log(timeTasks.value)
</script>

<template>
  <div
    v-for="(task, index) in selectedTasks"
    :key="task"
    class="task-ctn"
    :class="{ 'task-month' : isActive.monthly}"
    :style="{
      gridRowStart: `${gridSelectedTasks[index].gridRowStart}`,
      gridRowEnd: `${gridSelectedTasks[index].gridRowEnd}`
    }"
  >
    <div v-if="isMobile && isActive.monthly" class="timeStartEnd">
      <p class="ptimeStart">{{ timeTasks[index].timeStart }}</p>
      <p class="ptimeEnd">{{ timeTasks[index].timeEnd }}</p>
    </div>
    <div class="border"></div>
    <div class="TaskBox" @click="$emit('editTask', task)">
      <p class="p bold task-name">
        {{ task.name }}
      </p>
      <p class="p task-description">
        {{ task.description }}
      </p>
      <div v-if="!isMobile && isActive.daily" class="penIcon">
        <link
          rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"
        />
        <span class="material-symbols-outlined" @click="$emit('editTask', task)"> edit </span>
      </div>
    </div>
  </div>
</template>


<style scoped>

div {
  display: flex;
}

.TaskBox {
  width: 100%;
  flex-direction: row;
  flex-wrap: wrap;
  background-color: var(--beige-transp);
  border-radius: 0rem 0.3rem 0.3rem 0rem;
  cursor: pointer;
}

.border {
  width: 1rem;
  background-color: var(--brown);
  border-radius: 0.3rem 0rem 0rem 0.3rem;
}

.task-ctn {
  min-height: 2rem;
  grid-column-start: 2;
  /* transform: translateY(1rem) */
}

.task-name,
.task-description {
  margin: 0.35rem;
}
.penIcon{
  display: flex;
  width: 100%;
  justify-content: flex-end;
}
span {
  margin: .3rem; 
  color:var(--green);
}

.task-month {
  margin: 1rem 0 1rem 0;
  min-height: 4rem;
}

.task-month .TaskBox {
  display: flex;
  flex-direction: column;
  padding: 1rem;
}

.task-month .TaskBox p {
  margin: 0;
}

@media (max-width: 992px){
  .TaskBox{
    flex-direction: column;
  }
}
</style>

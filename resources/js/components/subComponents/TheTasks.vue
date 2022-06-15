<script async setup>
import { ref, computed, watchEffect, onMounted } from "vue";
import { axiosClient } from "../../utils/axios.js";
import BaseButton from "../../components/subComponents/BaseButton.vue";
import BaseBox from "../../components/subComponents/BaseBox.vue";
import { selectedTasks, tasksTmpl, isMobile } from "../../stores.js";

// function getTask(d){
//   if( d.dateStart.substr(0,10) == props.day.fullDate){
//     return true
//   }
//   return false
// }
const emit = defineEmits(["editTask"])

const taskRefs = ref([]);

  watchEffect(() => {
  console.log(taskRefs.value)
  // if (taskRefs.value) {
  for (let i = 0; i < taskRefs.value.length; i++) {
    const taskHourStart = selectedTasks.value[i].hourStart
    const taskHourEnd = selectedTasks.value[i].hourEnd
    console.log(taskHourEnd)
    taskRefs.value[i].style.gridRowStart = parseInt(taskHourStart) + 1
    taskRefs.value[i].style.gridRowEnd = parseInt(taskHourEnd) + 1
  }
  // }

})

</script>
<template>
  <div
    v-for="(task, index) in selectedTasks"
    :key="task"
    ref="taskRefs"
    class="task-ctn"
    :class="`task-${index + 1}`"
  >
    <div class="border"></div>
    <div class="TaskBox" @click="$emit('editTask', task)">
      <p class="p bold task-name">
        {{ task.name }}
      </p>
      <p class="p task-description">
        {{ task.description }}
      </p>
      <div v-if!="isMobile" class="penIcon">
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
/* #body {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
} */

div {
  display: flex;
}

.TaskBox {
  width: 100%;
  flex-direction: row;
  flex-wrap: wrap;
  /* margin: 1rem 1rem 1rem 0rem; */
  background-color: #f1dfcd79;
  border-radius: 0rem 0.3rem 0.3rem 0rem;
  cursor: pointer;
}

.border {
  width: 1rem;
  /* margin: 1rem 0rem 1rem 1rem; */
  background-color: #f1dfcd;
  border-radius: 0.3rem 0rem 0rem 0.3rem;
}

.task-ctn {
  min-height: 2rem;
  /* grid-row: 1 / 25; */
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

</style>

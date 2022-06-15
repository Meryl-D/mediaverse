<script async setup>
import { ref, computed, watchEffect, onMounted } from "vue";
import { axiosClient } from "../../utils/axios.js";
import BaseButton from "../../components/subComponents/BaseButton.vue";
import BaseBox from "../../components/subComponents/BaseBox.vue";
import { selectedTasks, tasksTmpl } from '../../stores.js'

// function getTask(d){
//   if( d.dateStart.substr(0,10) == props.day.fullDate){
//     return true
//   }
//   return false
// }

const taskRefs = ref([])

defineExpose({
  taskRefs
})

onMounted(() => {
  //console.log(selectedTasks.value)
  watchEffect(() => {
      
      // tasksTmpl.value = taskRefs
      // console.log(taskRefs.value)
  })
})

</script>
<template>
    <div
      v-for="(task, index) in selectedTasks"
      :key="task"
      ref="taskRefs"
      class="task-ctn"
      :class="`task-${index + 1}`"
    ><div class="border"></div>
     <div class="TaskBox">
        <p class="p bold task-name">
          {{ task.name }}
        </p>
        <p class="p task-description">
          {{ task.description }}
        </p>
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
  background-color: #F1DFCD79;
  border-radius: 0rem 0.3rem 0.3rem 0rem;
}

.border {
  width: 1rem;
  /* margin: 1rem 0rem 1rem 1rem; */
  background-color: #F1DFCD;
  border-radius: 0.3rem 0rem 0rem 0.3rem;
}

.task-ctn {
  min-height: 2rem;
  /* grid-row: 1 / 25; */
  grid-column-start: 2;
  /* transform: translateY(1rem) */
}

.task-name, .task-description {
  margin: .35rem;
}
</style>

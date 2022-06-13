<script async setup>
import { ref, computed, watchEffect } from "vue";
import { axiosClient } from "../../utils/axios.js";
import BaseButton from "../../components/subComponents/BaseButton.vue";
import BaseBox from "../../components/subComponents/BaseBox.vue";
import { selectedTasks } from '../../stores.js'

const props = defineProps({
  tasks: {
  type: Object,
  required: true,
  }
})

// watchEffect(() => {
//   selectedTasks.value = []
//   allData.forEach(data => {
//     if( data.dateStart.substr(0,10) == props.day.fullDate){
//         selectedTasks.value.push(data)
//     }
//   });
// })

// function getTask(d){
//   if( d.dateStart.substr(0,10) == props.day.fullDate){
//     return true
//   }
//   return false
// }

</script>
<template>
    <div
      v-for="(data, index) in allData"
      :key="data"
      class="task-ctn"
    ><div v-if="getTask(data)" :class="`task-${index}`">
      <div class="border"></div>
      <div class="TaskBox">
        <p class="p bold task-name">
          {{ data.name }}
        </p>
        <p class="p task-description">
          {{ data.description }}
        </p>
      </div>
      </div>
    </div>
          <!-- <div>{{ allData.dateStart }}</div>
            <div>{{ allData.dateEnd }}</div> -->
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
  flex-direction: column;
  padding: 1em;
  margin: 1rem 1rem 1rem 0rem;
  background-color: #F1DFCD79;
  border-radius: 0rem 0.3rem 0.3rem 0rem;
}

.border {
  width: 1rem;
  margin: 1rem 0rem 1rem 1rem;
  background-color: #F1DFCD;
  border-radius: 0.3rem 0rem 0rem 0.3rem;
}
</style>

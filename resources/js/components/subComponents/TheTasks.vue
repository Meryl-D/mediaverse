<script async setup>
import { ref, computed } from "vue";
import { axiosClient } from "../../utils/axios.js";
import BaseButton from "../../components/subComponents/BaseButton.vue";
import BaseBox from "../../components/subComponents/BaseBox.vue";

async function tasks() {
  const { data } = await axiosClient.get("api/tasks");
  return data;
}

const allDatas = await tasks();
//console.log(allDatas);


</script>
<template>
    <div
      v-for="allData in allDatas"
      :key="allData.id"
      class="course-ctn"
    >
      <div class="border"></div>
      <div class="TaskBox">
        <p class="p bold task-name">
          {{ allData.name }}
        </p>
        <p class="p task-description">
          {{ allData.description }}
        </p>
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

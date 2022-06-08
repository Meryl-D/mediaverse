<script async setup>
import { ref, computed } from "vue";
import { axiosClient } from "../utils/axios.js";
import BaseButton from "../components/subComponents/BaseButton.vue";

async function results() {
  const { data } = await axiosClient.get("api/results");
  return data;
}

const allData = await results();
console.log(allData);

//get the semester
let maxSemester = 0
for (const result in allData) {
    if (Object.hasOwnProperty.call(allData, result)) {
        const element = allData[result];
        if(element.semesterNo >= compteur){
            compteur = element.semesterNo
        }
    }
} 

</script>

<template>
  <h1>Notes</h1>

  <!-- <div>
    <span v-for="n in 10">{{ n }} </span>
  </div> -->

  <base-button type="submit">Envoyer</base-button>

  <ul>
    <li v-for="result in allData" :key="result.grade">
      <div>{{ result.CourseName }}</div>
      <div>{{ result.grade }}</div>

      <br />
    </li>
  </ul>
</template>


<style scoped>
</style>

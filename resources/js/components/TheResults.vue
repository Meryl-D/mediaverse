<script async setup>
import { ref, computed } from "vue";
import { axiosClient } from "../utils/axios.js";
import BaseButton from "../components/subComponents/BaseButton.vue";
import BaseBox from "../components/subComponents/BaseBox.vue";

async function results() {
  const { data } = await axiosClient.get("api/results");
  return data;
}

const allData = await results();
console.log(allData);

//get semester
let maxSemester = 0;
for (const result in allData) {
  if (Object.hasOwnProperty.call(allData, result)) {
    const element = allData[result];
    if (element.semesterNo >= maxSemester) {
      maxSemester = element.semesterNo;
    }
  }
}

const semester = ref(0);

function smsChoosen(id) {
  semester.value = id
  console.log(semester.value);
}

console.log(allData);
</script>

<template>
  <h1>Notes</h1>

  <div>
    <span v-for="i in maxSemester" :key="i">
      <base-button @click="smsChoosen(i)" type="submit">S{{ i }}</base-button>
    </span>
  </div>

  <span v-for="result in allData" :key="result.grade">
    <base-box>
      <div>{{ result.moduleName }} |</div>
      <div>
        | <strong>{{ result.CourseName }}</strong> |
      </div>
      <div>| {{ result.gradeWeight }} |</div>
      <div>| {{ result.grade }}</div>
    </base-box>
  </span>
</template>

<style scoped>
</style>

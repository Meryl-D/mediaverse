<script async setup>
import { ref, computed } from "vue";
import { axiosClient } from "../utils/axios.js";
import BaseButton from "../components/subComponents/BaseButton.vue";
import BaseBox from "../components/subComponents/BaseBox.vue";
import TheHeaderMobile from "./subComponents/TheHeaderMobile.vue";


async function results() {
  const { data } = await axiosClient.get("api/results");
  return data;
}

const allData = await results();
console.log(allData);

let dataFiltred = []
let n = 0
allData.forEach(d => {
  if (d.resultId == allData[0].resultId) {
    dataFiltred[n] = d
    n++
  }
});
console.log(dataFiltred)



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
  semester.value = id;
  console.log(semester.value);
}


</script>

<template>
<the-header-mobile class="header-mobile"></the-header-mobile>
  <h1>Notes</h1>
  <div id="semester">
    <div v-for="i in maxSemester" :key="i">
      <base-button @click="smsChoosen(i)" type="submit">S{{ i }}</base-button>
    </div>
  </div>
  <div id="body">
    <base-box id="file">
      <div v-for="result in allData" :key="result.grade">
        <div>
          <p>{{ result.moduleName }}</p>
          <p>
            <strong>{{ result.CourseName }}</strong> (coeff: {{ result.courseWeight }})
          </p>
          <p>{{ result.gradeType }} ({{ result.gradeWeight }}%) : <strong>{{ result.grade }}</strong></p>
        </div>
        <hr />
      </div>
    </base-box>

    <base-button>Télécharger le pdf</base-button>
  </div>
</template>

<style scoped>
#body {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

h1 {
  text-align: center;
  margin-top: 1%;
  margin-bottom: 1%;
}

#semester {
  display: flex;
  flex-direction: row;
  justify-content: center;
  margin-bottom: 1%;
}

#file {
  display: flex;
  flex-direction: column;
  padding: 1%;
  width: 80%;
}
</style>

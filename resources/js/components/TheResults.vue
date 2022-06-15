<script async setup>
import { ref, computed } from "vue"
import { axiosClient } from "../utils/axios.js"
import BaseButton from "../components/subComponents/BaseButton.vue"
import BaseBox from "../components/subComponents/BaseBox.vue"
import TheHeaderMobile from "./subComponents/TheHeaderMobile.vue"
import BaseModule from "./subComponents/BaseModule.vue"

async function results() {
  const { data } = await axiosClient.get("api/results");
  return data;
}

const allResults = await results();

const sortData = ref([]);
const modules = ["nothing"];

allResults.forEach((result) => {
  if (modules.some((e) => e != result.moduleName)) {
    let newModule = {
      CourseName: result.moduleName,
      semesterNo: result.semesterNo,
    };
    modules.push(newModule);
  }
});
modules.splice(0, 1);
console.log(modules);

let dataFiltred = [];
let n = 0;
allResults.forEach((d) => {
  if (d.resultId == allResults[0].resultId) {
    dataFiltred[n] = d;
    n++;
  }
});
console.log(dataFiltred);

//get semester
let maxSemester = 0;
for (const result in allResults) {
  if (Object.hasOwnProperty.call(allResults, result)) {
    const element = allResults[result];
    if (element.semesterNo >= maxSemester) {
      maxSemester = element.semesterNo;
    }
  }
}

const semester = ref(0);

function smsChoosen(id) {
  semester.value = id;
    for(let module in modules){
      if(modules[module].semesterNo == id)
     console.log(modules[module]);
  }

  // allResults.forEach(result => {
  //   if(result.moduleName === )
    
  // });
}
</script>

<template>
  <the-header-mobile class="header-mobile"></the-header-mobile>
  <div id="file">
    <div id="header">
      <h1>Notes</h1>
      <div id="semester">
        <div v-for="i in maxSemester" :key="i" class="semester">
          <base-button @click="smsChoosen(i)" type="submit"
            >S{{ i }}</base-button
          >
        </div>
      </div>
    </div>
    <div id="body">
      <div id="result">
        <div v-for="result in allResults" :key="result.grade">
          <div>
            <p>
              <strong>{{ result.moduleName }}</strong>
            </p>
            <p>{{ result.CourseName }}(coeff: {{ result.courseWeight }})</p>
            <p>
              {{ result.gradeType }} ({{ result.gradeWeight }}%) :
              <strong>{{ result.grade }}</strong>
            </p>
          </div>
          <hr />
        </div>
      </div>
      <div id="btn-container">
        <base-button class="btn">Télécharger le pdf</base-button>
      </div>
    </div>
  </div>
</template>

<style scoped>
#file {
  width: 100%;
}
#body {
  display: flex;
  flex-direction: column;
}
#header {
  margin-bottom: 2%;
}

h1 {
  text-align: center;
  margin-top: 1%;
  margin-bottom: 1%;
}

#semester {
  display: flex;
  flex-direction: row;
  justify-content: flex-start;
  margin: 1%;
}
.semester {
  margin: 2%;
}

#result {
  display: flex;
  flex-direction: column;
  margin-right: 1rem;
  margin-left: 1rem;
}
#btn-container {
  width: 100%;
  justify-content: left;
  padding-left: 1rem;
}
.btn {
  width: 40%;
}
</style>

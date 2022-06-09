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
console.log(allDatas);

// let dataFiltred = []
// let n = 0
// allData.forEach(d => {
//   if (d.resultId == allData[0].resultId) {
//     dataFiltred[n] = d
//     n++
//   }
// });
// console.log(dataFiltred)



// //get semester
// let maxSemester = 0;
// for (const result in allData) {
//   if (Object.hasOwnProperty.call(allData, result)) {
//     const element = allData[result];
//     if (element.semesterNo >= maxSemester) {
//       maxSemester = element.semesterNo;
//     }
//   }
// }

// const semester = ref(0);

// function smsChoosen(id) {
//   semester.value = id;
//   console.log(semester.value);
// }


</script>
<template>
<h1></h1>
    <div id="task">
        <ul v-for="allData in allDatas" :key="allData.id" id="task2">

            <div id="titre">{{ allData.name }}</div>
            <div>{{ allData.description }}</div>
            <!-- <div>{{ allData.dateStart }}</div>
            <div>{{ allData.dateEnd }}</div> -->
        </ul>
    </div>


    <!-- <div v-show="student">
        <h1>Saisir une review :</h1>
        <select @change="test()">
            <option>Sélectionnez un cours</option>
            <option  v-for="reviewPossible in reviewsPossibles" :key="reviewPossible" :class="reviewPossible">
                {{ reviewPossible }} </option>
        </select>
    </div> -->
</template>




<!-- <template>
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
</template> -->

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

#task {
  display: flex;
  flex-direction: row;
  justify-content: center;
  margin-bottom: 1%;
  background-color: var(--beige);
}

#task2 {
  /* display: flex;
  flex-direction: row;
  justify-content: center;
  margin-bottom: 1%; */
  background-color: var(--beige);
}

#file {
  display: flex;
  flex-direction: column;
  padding: 1%;
  width: 80%;
}

#titre {
font-weight: bold;
}
</style>

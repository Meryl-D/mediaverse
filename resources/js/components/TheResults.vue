<script async setup>
import { ref, computed } from 'vue';
import { axiosClient } from "../utils/axios.js";


async function results() {
  const { data } = await axiosClient.get('api/results');
  return data
}

const allData = await results()
const module = allData.modules
console.log(allData)

const test = Object.keys(allData).length
console.log(test)

let tabResults = []
let compteur = 0
for (const result in allData) {
    if (Object.hasOwnProperty.call(allData, result)) {
        let oneResult = allData[result][compteur]
        console.log("c'est un ", result, allData[result][compteur])
    }
}


</script>

<template>
<h1>Notes</h1>

        <ul>
            <li v-for="result in module" :key="result.id">
                <div>{{ result.name }}</div>
            </li>
        </ul>
        <h2>Cours</h2>
          <ul>
            <li v-for="result in allData.results" :key="result.id">
                <div>{{ result.grade }}</div>
            </li>
        </ul>

</template>


<style></style>

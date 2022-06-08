<script setup>
import { ref, computed } from 'vue';
import { axiosClient } from "../utils/axios.js";


async function absences() {
  const { data } = await axiosClient.get('api/absences');
  return data
}

const test = await absences()

console.log(test)


const items = ref([{ message: 'Foo' }, { message: 'Bar' }])

</script>

<template>
<h1>Absences</h1>

        <ul>
            <li v-for="absence in test" :key="absence.id">
                <div>{{ absence}}</div>
            </li>
        </ul>

</template>


<style></style>

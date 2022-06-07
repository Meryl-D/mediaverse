<script setup>
import { ref, computed } from 'vue';
import { axiosClient } from "../utils/axios.js";


async function results() {
  const { data } = await axiosClient.get('api/results');
  return data
}

const test = await results()
const module = test.modules
console.log(module)


const items = ref([{ message: 'Foo' }, { message: 'Bar' }])

</script>

<template>
<h1>Notes</h1>

        <ul>
            <li v-for="result in module" :key="result.id">
                <div>{{ result.name}}</div>
            </li>
        </ul>

</template>


<style></style>

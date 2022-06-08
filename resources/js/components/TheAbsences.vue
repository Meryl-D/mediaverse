<script setup>
import { ref, computed } from "vue";
import { axiosClient } from "../utils/axios.js";
import BaseButton from "../components/subComponents/BaseButton.vue";

async function absences() {
  const { data } = await axiosClient.get("api/absences");
  return data;
}

const listAbsences = await absences();

console.log(listAbsences);

const items = ref([{ message: "Foo" }, { message: "Bar" }]);
</script>

<template>
  <section>
    <h1>Absences</h1>
    <div classe="filtres">
      <base-button type="submit">S1</base-button>
      <base-button type="submit">S2</base-button>
      <base-button type="submit">S3</base-button>
      <base-button type="submit">S4</base-button>
      <base-button type="submit">S5</base-button>
      <base-button type="submit">S6</base-button>
    </div>
  </section>
  <ul>
    <li v-for="absence in listAbsences" :key="absence.id">
      <div>{{ absence.state }}</div>
      <div>{{ absence.name }}</div>
      <div>{{ absence.date }}</div>
    </li>
  </ul>
</template>


<style></style>

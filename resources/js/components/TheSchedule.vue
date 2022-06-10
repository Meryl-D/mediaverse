<script setup>
import { ref, watchEffect } from "vue";
import { axiosClient } from "../utils/axios.js";
import { user } from "../stores.js";
import TheWeeklySchedule from "./subComponents/TheWeeklySchedule.vue";
import TheDailySchedule from "./subComponents/TheDailySchedule.vue";
import TheMonthlySchedule from "./subComponents/TheMonthlySchedule.vue";


const { data } = await axios.get("/api/lessons", {
  headers: { Authorization: `Bearer ${user.value.token}` },
});

const tasks = await axiosClient.get("/api/tasks", {
  headers: { Authorization: `Bearer ${user.value.token}` },
});

</script>

<template>
<the-header-mobil></the-header-mobil>
  <!-- <the-weekly-schedule :content="data.weekDaysSchedule"></the-weekly-schedule> -->
<<<<<<< HEAD
  <the-daily-schedule :days="data.allDaysSchedule" :today="data.today"></the-daily-schedule> 
=======
  <the-daily-schedule
    :days="data.allDaysSchedule"
    :today="data.today"
  ></the-daily-schedule>
  
  <!-- <the-weekly-schedule :schedule="data.weekDaysSchedule"></the-weekly-schedule> -->
  <!-- <the-weekly-schedule :schedule="data.weekDaysSchedule"></the-weekly-schedule> -->
  <!-- <the-monthly-schedule :schedule="data.allDaysSchedule"></the-monthly-schedule> -->
  <!-- <the-daily-schedule :days="data.allDaysSchedule" :today="data.today"></the-daily-schedule> -->
<<<<<<< HEAD
  <!-- <the-monthly-schedule :schedule="data.allDaysSchedule"></the-monthly-schedule> -->
=======
>>>>>>> 31cac75eb6cf3df1e6c4e07a0a402c153cbd154b
  <the-monthly-schedule :schedule="data.allDaysSchedule"></the-monthly-schedule>
  >
>>>>>>> 5009b1aea150c6d994372bb8bfe68c905503d1b2
</template>

<style scoped>
</style>

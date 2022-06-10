<script setup>
import { ref, watchEffect } from "vue";
import { axiosClient } from "../utils/axios.js";
import { user } from "../stores.js";
import TheWeeklySchedule from "./subComponents/TheWeeklySchedule.vue";
import TheDailySchedule from "./subComponents/TheDailySchedule.vue";
import TheMonthlySchedule from "./subComponents/TheMonthlySchedule.vue";
import BaseGrille from "./subComponents/BaseGrille.vue";
import TheHeaderMobile from "./subComponents/TheHeaderMobile.vue";

const { data } = await axios.get("/api/lessons", {
  headers: { Authorization: `Bearer ${user.value.token}` },
});

</script>

<template>
  <the-header-mobile></the-header-mobile>
  <!-- <the-weekly-schedule :content="data.weekDaysSchedule"></the-weekly-schedule> -->
  <the-daily-schedule :days="data.allDaysSchedule" :today="data.today"></the-daily-schedule>
  <the-monthly-schedule :schedule="data.allDaysSchedule"></the-monthly-schedule>
  >
</template>

<style scoped>
</style>
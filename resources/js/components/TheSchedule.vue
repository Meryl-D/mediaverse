<script setup>
import { ref, watchEffect } from "vue";
import { axiosClient } from "../utils/axios.js";
import { user } from "../stores.js";
import TheWeeklySchedule from "./subComponents/TheWeeklySchedule.vue";
import TheDailySchedule from "./subComponents/TheDailySchedule.vue";
import TheMonthlySchedule from "./subComponents/TheMonthlySchedule.vue";
import BaseGrille from "./subComponents/BaseGrille.vue";

const { data } = await axios.get("/api/lessons", {
  headers: { Authorization: `Bearer ${user.value.token}` },
});

</script>

<template>
    <the-weekly-schedule 
    :schedule="data.weekDaysSchedule"
    :today="data.today"
    >
    </the-weekly-schedule>

    <the-header-mobil></the-header-mobil>

  <!-- <base-grille :today="data.allDaysSchedule" tasks=""></base-grille> -->
  <!-- <the-monthly-schedule :schedule="data.allDaysSchedule" :days="data.allDaysSchedule" :today="data.today"></the-monthly-schedule>-->

  <!-- <the-daily-schedule :days="data.allDaysSchedule" :today="data.today"></the-daily-schedule>  -->
  
</template>

<style scoped>
</style>
<script setup>
import { ref, watchEffect } from "vue";
import { axiosClient } from "../utils/axios.js";
import { user, isActive } from "../stores.js";
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
  <the-header-mobile class="header-mobile"></the-header-mobile>
  <div class="weekly-box" v-if="isActive.weekly">
    <the-weekly-schedule :schedule="data.weekDaysSchedule" :today="data.today" :nextMonday="data.nextMonday">
    </the-weekly-schedule>
  </div>

  <the-daily-schedule class="daily-schedule" v-if="isActive.daily" :days="data.allDaysSchedule" :today="data.today">
  </the-daily-schedule>

  <the-monthly-schedule class="monthly-schedule" v-if="isActive.monthly" :schedule="data.allDaysSchedule">
  </the-monthly-schedule>
</template>

<style scoped>
.header-mobile {
  height: 10vh;
  position: relative;
  z-index: 1;

}

.weekly-box {
  width: 100vw;
  height: 90vh;
  display: flex;
  justify-content: center;


}

</style>
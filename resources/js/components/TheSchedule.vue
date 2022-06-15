<script setup>
import { onMounted, ref, watchEffect } from "vue";
import { axiosClient } from "../utils/axios.js";
import { user, isActive } from "../stores.js";
import TheWeeklySchedule from "./subComponents/TheWeeklySchedule.vue";
import TheDailySchedule from "./subComponents/TheDailySchedule.vue";
import TheMonthlySchedule from "./subComponents/TheMonthlySchedule.vue";
import BaseGrille from "./subComponents/BaseGrid.vue";
import TheHeaderMobile from "./subComponents/TheHeaderMobile.vue";
import TheHeaderDesktop from "./subComponents/TheHeaderDesktop.vue";
import { useWindowSize } from 'vue-window-size';

const { data } = await axios.get("/api/lessons", {
  headers: { Authorization: `Bearer ${user.value.token}` },
});

const allTasks = await axiosClient.get("api/tasks", {
  headers: { Authorization: `Bearer ${user.value.token}` },
});

const { width, height } = useWindowSize()
const isMobile = ref();

watchEffect(() => {
  if (width.value < 992) {
    isMobile.value = true;
  } else {
    isMobile.value = false;
  }
});
</script>

<template>
<div>
    <the-header-mobile v-if="isMobile" class="header-mobile"></the-header-mobile>
    <the-header-desktop v-if="!isMobile" class="header-desktop"></the-header-desktop>

  <div class="weekly-box horaire" v-if="isActive.weekly">
    <the-weekly-schedule
      :schedule="data.weekDaysSchedule"
      :today="data.today"
      :nextMonday="data.nextMonday"
      :isMobile="isMobile"
      :tasks="allTasks.data"
    ></the-weekly-schedule>
  </div>

    <div class="horaire">
      <the-daily-schedule
        v-if="isActive.daily"
        :days="data.allDaysSchedule"
        :today="data.today"
        :tasks="allTasks.data">
      </the-daily-schedule>
    </div>

  <the-monthly-schedule
    class="monthly-schedule"
    v-if="isActive.monthly"
    :schedule="data.allDaysSchedule"
    :days="data.allDaysSchedule"
    :tasks="allTasks.data"
  >
  </the-monthly-schedule>
</template>

<style scoped>
.header-mobile {
  height: 10vh;
  position: relative;
  z-index: 1;
}

.header-desktop {
  width: 300px;
  height: 100%;
  position: absolute;
  background-color: var(--white);
  filter: drop-shadow(0px 0px 20px rgba(0, 0, 0, 0.5));
  z-index: 1;
  transform: none;
  visibility: visible;
  /* z-index: 1; */

}

/* .weekly-box {
  width: 100vw;
  height: 90vh;
  display: flex;
  justify-content: center;
} */

@media (min-width: 992px) {
  .weekly-box {
    display: flex;
    height: 100vh;
    flex-direction: column;
    align-items: center;
  }

  .horaire {
    width: 100vw;
    height: 100vh;
    position: absolute;
    padding-left: 350px;
    padding-top: 200px;
    padding-right: 80px;
    /* z-index: 1; */

  }
}
</style>
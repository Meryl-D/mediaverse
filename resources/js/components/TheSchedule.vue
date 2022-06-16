<script setup>
import { onMounted, ref, watchEffect } from "vue";
import { axiosClient } from "../utils/axios.js";
import { user, isActive, isMobile } from "../stores.js";
import TheWeeklySchedule from "./subComponents/TheWeeklySchedule.vue";
import TheDailySchedule from "./subComponents/TheDailySchedule.vue";
import TheMonthlySchedule from "./subComponents/TheMonthlySchedule.vue";
import BaseGrille from "./subComponents/BaseGrid.vue";
import TheHeaderMobile from "./subComponents/TheHeaderMobile.vue";
import TheHeaderDesktop from "./subComponents/TheHeaderDesktop.vue";
import { useWindowSize } from "vue-window-size";

const { data } = await axios.get("/api/lessons", {
  headers: { Authorization: `Bearer ${user.value.token}` },
});

const allTasks = await axiosClient.get("api/tasks", {
  headers: { Authorization: `Bearer ${user.value.token}` },
});

</script>

<template>
<div id="schedule-view">
  <the-header-mobile
    v-if="isMobile"
    class="header-mobile"
  ></the-header-mobile>
  <the-header-desktop
    v-if="!isMobile"
    class="header-desktop"
  ></the-header-desktop>

  <section id="schedule">
      <the-weekly-schedule v-if="isActive.weekly"
      :schedule="data.weekDaysSchedule"
      :today="data.today"
      :nextMonday="data.nextMonday"
      :isMobile="isMobile"
      :tasks="allTasks.data"
    ></the-weekly-schedule>

    <the-daily-schedule
      v-if="isActive.daily"
      :days="data.allDaysSchedule"
      :tasks="allTasks.data"
    >
    </the-daily-schedule>

    <the-monthly-schedule
      class="monthly-schedule horaire"
      v-if="isActive.monthly"
      :schedule="data.allDaysSchedule"
      :days="data.allDaysSchedule"
      :tasks="allTasks.data"
    >
    </the-monthly-schedule>
  </section>
</div>
</template>

<style scoped>
@media(min-width: 992px){
  #schedule-view {
  display: flex;
}
}

.header-mobile {
  height: 10vh;
  position: -webkit-sticky;
  position: sticky;
  top: 0;
  z-index: 1;
  background-color: var(--white);
}

.header-desktop {
  display: flex;
  flex-direction: column;
  padding: 2.5rem;
  width: 280px;
  min-height: 100vh;
  position: -webkit-sticky;
  position: sticky;
  background-color: var(--white);
  filter: drop-shadow(0px 0px 10px rgba(0, 0, 0, 0.3));
  z-index: 1;
}

/* .weekly-box {
  width: 100vw;
  height: 90vh;
  display: flex;
  justify-content: center;
} */
@media (max-width: 991px) {
  #schedule {
    min-height: 90vh;
  }
}


@media (min-width: 992px) {

  #schedule {
    width: calc(100vw - 280px);
  }
  /* .weekly-box {
    display: flex;
    height: 100vh;
    flex-direction: column;
    align-items: center; */
  }

  /* .horaire {
    width: 100vw;
    height: 100vh;
    position: absolute;
    padding-left: 350px;
    padding-top: 200px;
    padding-right: 80px;
    /* z-index: 1; */

</style>
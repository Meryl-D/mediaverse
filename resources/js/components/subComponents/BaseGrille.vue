<script setup>
import BaseCourse from "./BaseCourse.vue";
import TheTasks from "./TheTasks.vue";
import { ref, onMounted } from "vue";
import { watchEffect } from "vue";

const props = defineProps({
  today: {
    type: String,
    required: false,
  },

  tasks: {
    type: Object,
    required: false,
  },
  day: {
    type: Object,
    required: true,
  },
});

const pos = {};

// let courseToShow = ref(Object)

// watchEffect(async () => {
//   courseToShow.value = props.day

// })

function createDate(currentDay) {
  let hour = Date(2018, 8, 22, 15, 0, 0).toString("MMMM dS, yyyy");
  return hour;
}
</script>

<template>
  <div class="grid">
    <div class="s"><div class="h">08:00</div></div>
    <div class="trait"><hr /></div>
    <div class="s"><div class="h">09:00</div></div>
    <div class="trait"><hr /></div>
    <div class="s"><div class="h">10:00</div></div>
    <div class="trait"><hr /></div>
    <div class="s"><div class="h">11:00</div></div>
    <div class="trait"><hr /></div>
    <div class="s"><div class="h">12:00</div></div>
    <div class="trait"><hr /></div>
    <div class="s"><div class="h">13:00</div></div>
    <div class="trait"><hr /></div>
    <div class="s"><div class="h">14:00</div></div>
    <div class="trait"><hr /></div>
    <div class="s"><div class="h">15:00</div></div>
    <div class="trait"><hr /></div>
    <div class="s"><div class="h">16:00</div></div>
    <div class="trait"><hr /></div>
    <div class="s"><div class="h">17:00</div></div>
    <div class="trait"><hr /></div>
    <div class="s"><div class="h">18:00</div></div>
    <div class="trait"><hr /></div>
    <div class="s"><div class="h">19:00</div></div>
    <div class="trait"><hr /></div>
    <div class="s"><div class="h">20:00</div></div>
    <div class="trait"><hr /></div>
    <div class="s"><div class="h">21:00</div></div>
    <div class="trait"><hr /></div>
    <div class="s"><div class="h">22:00</div></div>
    <div class="trait"><hr /></div>
    <div class="s"><div class="h">23:00</div></div>
    <div class="trait"><hr /></div>
  </div>
  <!-- <the-tasks :day="courseToShow"></the-tasks>
  <base-course :lessonDay="courseToShow"> </base-course> -->
</template>

<style scoped>
.grid {
  display: grid;
  grid-template-columns: 4% 96%;
  grid-row-gap: 0.5%;
  grid-column-gap: 1%;
  margin-left: 6.5%;
  margin-right: 6%;
}
.s {
  display: flex;
  align-items: center;
  justify-content: flex-start;
}

hr {
  color: gray;
}
hr {
  height: 0;
  border: none;
  border-top: 2px solid gray;
  background-color: transparent;
}
</style>
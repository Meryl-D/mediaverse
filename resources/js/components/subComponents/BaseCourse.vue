<script setup>
import { propExists } from "../../stores.js";
import { ref, watchEffect } from "vue";
import BaseBox from "./BaseBox.vue";
const props = defineProps({
  lessonDay: {
    type: Object,
    required: true,
  },
});
//console.log(props.lessonDay);

const courseExists = ref("");
const holidayExists = ref("");

function check() {
  courseExists.value = propExists("courses", props.lessonDay);
  holidayExists.value = propExists("holiday", props.lessonDay);
}

check();
watchEffect(() => {
  check();
});
</script>



<template>
  <div v-if="courseExists">
    <div
      v-for="course in props.lessonDay.courses"
      :key="course.name"
      class="course-ctn"
    >
      <div class="border"></div>
      <div class="DailyCourseBox">
        <p class="p bold course-name">
          {{ course.name }}
        </p>
        <p class="p course-room">
          {{ course.room }}
        </p>
      </div>
    </div>
  </div>
  <div v-if="holidayExists">
    <div class="border"></div>
    <div class="DailyCourseBox">
      <p class="p bold holiday-name">
        {{ props.lessonDay.holiday.name }}
      </p>
    </div>
  </div>
</template>

<style scoped>
div {
  display: flex;
}
.DailyCourseBox {
  flex-direction: column;
  padding: 1em;
  margin: 1rem 1rem 1rem 0rem;
  background-color: #e3cec279;
  border-radius: 0rem 0.3rem 0.3rem 0rem;
}
.border {
  width: 1rem;
  margin: 1rem 0rem 1rem 1rem;
  background-color: #e3cec2;
  border-radius: 0.3rem 0rem 0rem 0.3rem;
}
</style>

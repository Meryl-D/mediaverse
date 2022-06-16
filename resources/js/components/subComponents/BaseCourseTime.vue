<script setup>
import { propExists, isMobile } from "../../stores.js";
import { ref, watchEffect, onMounted } from "vue";
import BaseBox from "./BaseBox.vue";

const props = defineProps({
  lessonDay: {
    type: Object,
    required: true,
  },
});
// console.log(props.lessonDay);

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
  <div>
    <div v-if="courseExists" class="displayCourse">
      <div
        v-for="course in props.lessonDay.courses"
        :key="course.name"
        class="course-ctn"
        ref="courseDiv"
      >
        <div v-if="isMobile" class="timeStartEnd">
          <p class="ptimeStart">{{ course.timeStart }}</p>
          <p class="ptimeEnd">{{ course.timeEnd }}</p>
        </div>
        <div class="border"></div>
        <div class="DailyCourseBox">
          <p class="p bold course-name">
            {{ course.name }}
          </p>
          <p class="p course-room">
            {{ course.room }}
          </p>
          <p v-if="!isMobile">{{ course.timeStart }} : {{ course.timeEnd }}</p>
        </div>
      </div>
    </div>
    <div v-if="holidayExists" class="holidayBox">
      <div class="border"></div>
      <div class="DailyCourseBox">
        <p class="p bold holiday-name">
          {{ props.lessonDay.holiday.name }}
        </p>
      </div>
    </div>
  </div>
</template>

<style scoped>
div {
  display: flex;
  width: 100%;
}
.DailyCourseBox {
  flex-direction: column;
  padding: 1em;
  margin: 1rem 0rem 1rem 0rem;
  background-color: #e3cec279;
  border-radius: 0rem 0.3rem 0.3rem 0rem;
}
.border {
  width: 1rem;
  margin: 1rem 0rem 1rem 0rem;
  background-color: #e3cec2;
  border-radius: 0.3rem 0rem 0rem 0.3rem;
}
.displayCourse {
  flex-direction: column;
  width: 100%;
}
.timeStartEnd {
  display: flex;
  flex-direction: column;
}
@media (max-width: 992px) {
  .timeStart {
    display: inline;
  }
  .ptimeEnd {
    display: inline;
  }
  .ptimeStart {
    display: inline;
  }
  .course-ctn {
    margin: .7rem 0 .7rem 0;
    height: 4rem;
  }
  .DailyCourseBox {
    width: 100%;
    margin: 0;
    padding: 0 0 0 .3rem;
  }
  .border {
    margin: 0;
  }
  .timeStartEnd {
    /* display: flex;
    flex-direction: column; */
    margin-right: 1rem;
  }
  .p{
    display: inline;
  }
  .holidayBox{
    width: 100%;
  }
  div {
    display: inline-flex;
    width: auto;
  }
}
</style>

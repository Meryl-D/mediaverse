<script setup>
import { propExists, formatHourForGrid } from "../../stores.js";
import { ref, watchEffect, onMounted, computed } from "vue";
import BaseBox from "./BaseBox.vue";

const props = defineProps({
  lessonDay: {
    type: Object,
    required: true,
  },
});

console.log(props.lessonDay.courses)
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

const gridCourses = computed(() => {

  const courses = []
  if (!courseExists) return

  props.lessonDay.courses.forEach(course => {
    courses.push(
      {
      gridRowStart: formatHourForGrid(course.timeStart.substring(0, 2)),
      gridRowEnd: formatHourForGrid(course.timeEnd.substring(0, 2))
    }
    )
  });
  return courses
})
</script>

<template>
      <div
        v-for="(course, i) in props.lessonDay.courses"
        :key="course.name"
        class="course-ctn"
        :style="{
          display : courseExists ? 'flex' : 'none',
          gridRowStart: `${gridCourses[i].gridRowStart}`,
          gridRowEnd: `${gridCourses[i].gridRowEnd}`
        }"
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
  width: 100%;
  flex-direction: row;
  flex-wrap: wrap;
  background-color: var(--beige-transp);
  border-radius: 0rem 0.3rem 0.3rem 0rem;
  cursor: pointer;
}
.border {
  width: 1rem;
  background-color: var(--brown);
  border-radius: 0.3rem 0rem 0rem 0.3rem;
}
.displayCourse{
  flex-direction: column;
}

.DailyCourseBox .course-name, .DailyCourseBox .course-room {
    margin: 0.35rem;
}

.course-ctn {
  min-height: 2rem;
  grid-column-start: 2;
}


</style>

<script setup>
import { usePropExists } from "../../composables/propExists.js";

const props = defineProps({
    lessonDay: {
    type: Object,
    required: true,
    },
});

const exists = computed({
    get: () => exists.value,
    set: (val) => usePropExists('course1', props.lessonDay),
});
</script>

<template>
  <div class="lesson-ctn">
    <div class="date-ctn">
      <p class="day">
        {{ props.lessonDay.dayShort }}
      </p>
      <p class="date">
        {{ props.lessonDay.date }}
      </p>
    </div>
    <!-- <div v-if="usePropExists('course1', props.lessonDay)" class="course">
            <div v-for="course in lessonDay" :key="course" class="course-ctn">
                <p class="course-name">
                    {{ props.lessonDay.name }}
                </p>
                <p class="course-time">
                    {{ props.lessonDay.timeStart }}-{{ props.lessonDay.timeEnd }}
                </p>
                <p class="course-room">
                    {{ props.lessonDay.room }}
                </p>
            </div>
        </div> -->
  </div>
</template>

<style scoped>
</style>

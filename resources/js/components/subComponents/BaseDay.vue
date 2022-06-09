<script setup>
import { usePropExists } from '../../composables/propExists.js'
import { ref } from 'vue'

const props = defineProps({
    lessonDay: {
    type: Object,
    required: true,
    },
});

const courseExists = ref(usePropExists('courses', props.lessonDay))
const holidayExists = ref(usePropExists('holiday', props.lessonDay))
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
    <div class="info-ctn">
        <div v-if="courseExists">
            <div v-for="course in props.lessonDay.courses" :key="course.name" class="course-ctn">
                <p class="course-name">
                    {{ course.name }}
                </p>
                <p class="course-time">
                    {{ course.timeStart }}-{{ course.timeEnd }}
                </p>
                <p class="course-room">
                    {{ course.room }}
                </p>
            </div>
        </div>
        <div v-if="holidayExists">
            <p class="holiday-name">
                {{ props.lessonDay.holiday.name }}
            </p>
        </div>
    </div>
</div>
</template>

<style scoped>
    
</style>

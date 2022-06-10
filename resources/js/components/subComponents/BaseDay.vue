<script setup>
import { propExists } from '../../stores.js'
import { ref } from 'vue'

const props = defineProps({
    lessonDay: {
    type: Object,
    required: true,
    },
    today : {
        type : String,
        required : true
    }
});

let isToday = false;
if (props.today == props.lessonDay.fullDate) isToday = true;

const courseExists = propExists('courses', props.lessonDay)
const holidayExists = propExists('holiday', props.lessonDay)
</script>

<template>
<div class="lesson-ctn">
    <div class="date-ctn" :class="{ 'today' : isToday }">
        <p class="day">
        {{ props.lessonDay.dayShort }}
        </p>
        <p class="date">
        {{ props.lessonDay.date }}
        </p>
    </div>
    <div class="info-ctn">
        <div v-if="courseExists" class="course">
            <div v-for="course in props.lessonDay.courses" :key="course.name" class="course-ctn">
                <p class="course-name">
                    {{ course.name }}
                </p>
                <p class="course-room">
                    {{ course.room }}
                </p>
                <p class="course-time">
                    {{ course.timeStart }}-{{ course.timeEnd }}
                </p>
            </div>
        </div>
        <div v-if="holidayExists" class="holiday">
            <p class="holiday-name">
                {{ props.lessonDay.holiday.name }}
            </p>
        </div>
    </div>
    <!-- <hr class="sep"> -->
</div>
</template>

<style scoped>
    * {
        margin: 0;
    }

    .lesson-ctn {
        display: flex;
        flex: 1;
        padding: 1rem 2rem;
    }

    .date-ctn {
        display: flex;
        flex-direction: column;
        flex: 1;
        justify-content: center;
    }

    .info-ctn {
        display: flex;
        flex: 3;
    }

    .course {
        display: flex;
        flex-direction: column;
        flex: 1;
        justify-content: center;
    }

    .course-ctn {
        display: flex;
        flex-wrap: wrap;
    }

    .course-name {
        flex: 3;
    }

    .course-room {
        flex: 1;
        text-align: end;
    }

    .course-time {
        flex-basis: 100%;
    }

    .holiday {
        display: flex;
        align-items: center;
    }

    .today {
        color : var(--orange);
    }
</style>

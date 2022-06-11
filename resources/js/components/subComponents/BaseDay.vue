<script setup>
import { propExists, selectedDate, isActive } from '../../stores.js'
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


function toDailyView() {
    selectedDate.value = props.lessonDay
    isActive.value.weekly = false
    isActive.value.daily = true
}
</script>

<template>
<div class="lesson-ctn" @click="toDailyView()">
    <div class="date-ctn" :class="{ 'today' : isToday }">
        <div class="day-date">
            <p class="day">
                {{ props.lessonDay.dayShort }}
                </p>
                <p class="date">
                {{ props.lessonDay.date }}
            </p>
        </div>
    </div>
    <div class="info-ctn">
        <div v-if="courseExists" class="course">
            <div v-for="course in props.lessonDay.courses" :key="course.name" class="course-ctn">
                <p class="course-name bold">
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
            <p class="holiday-name bold">
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
        padding: 0rem 2rem;
    }

    .date-ctn {
        display: flex;
        flex: 1;
        align-items: center;
    }

    .date {
        font-size: 1.5rem; 
        font-weight: 900;
    }

    .day {
        font-size: 1rem;
    }

    .day-date {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .info-ctn {
        display: flex;
        flex: 4;
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
        padding: .2rem;
    }

    .course-name {
        flex: 2;
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

    .today .date, .today .day {
        color : var(--orange);
    }

    .holiday-name {
        padding: .2rem;
    }
</style>

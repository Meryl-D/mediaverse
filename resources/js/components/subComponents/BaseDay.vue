<script setup>
import { propExists, selectedDate, isActive, isMobile } from '../../stores.js'
import { ref } from 'vue'

const props = defineProps({
    lessonDay: {
    type: Object,
    required: true,
    },
    today: {
        type: String,
        required: true
    },
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
            <p v-if="isMobile" class="day">
                {{ props.lessonDay.dayShort }}
            </p>
            <p v-if="!isMobile" class="day">
                {{ props.lessonDay.dayLong }}
            </p>
            <hr v-if="!isMobile" class="hr-date">
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
        padding: 0rem 1.5rem;
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
        flex: 3;
    }

    .course-room {
        flex: 2;
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

    @media (min-width: 576px) {
        .lesson-ctn {
            padding: 0rem 2.5rem;
        }

        .day {
            font-size: 1.1rem;
        }

        .date {
            font-size: 1.8rem;
        }
    }
    @media (min-width: 992px) {
 
        .date-ctn {
            flex: 0 1 auto;
            margin-bottom: .5rem;
        }

        .day-date {
            flex-basis: 100%;
            align-items: start;
        }

        .hr-date {
            border-top: 3px solid var(--green);
            opacity: 1;
            margin: .1rem 0;
        }

        .today .hr-date {
            border-color: var(--orange);
        }

        .info-ctn {
            align-items: start;
        }

        .course-ctn {
            flex-direction: column;
            padding: 0 0 1rem 0;
        }

        .course-room {
            text-align: start;
            order: 3;
        }

    }
</style>

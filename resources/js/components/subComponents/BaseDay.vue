<script setup>
import { propExists, selectedDate, isActive, isMobile } from '../../stores.js'
import { ref } from 'vue'

const props = defineProps({
    lessonDay: {
    type: Object,
    required: true,
    },
    today: {
        type: Object,
        required: true
    },
    isMobile: {
        type: Boolean,
        required: true
    },
    tasks : {
        type: Object,
        required : true
    }
});

let isToday = false;
if (props.today.fullDate == props.lessonDay.fullDate) isToday = true;

const courseExists = propExists('courses', props.lessonDay)
const holidayExists = propExists('holiday', props.lessonDay)


function toDailyView() {
    selectedDate.value = props.lessonDay
    isActive.value.weekly = false
    isActive.value.daily = true
}
const hasCourse = props.lessonDay.courses ? true : false;

const hasTask = props.tasks.some(task => task.dateStart.substr(0,10) == props.lessonDay.fullDate || task.dateEnd.substr(0,10) == props.lessonDay.fullDate);
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
            <div class="date-circles">
                <p class="date">
                    {{ props.lessonDay.date }}
                </p>
                <div class="circles">
                    <div v-if="hasTask" class="task-circle"></div>
                    <div v-if="hasCourse" class="course-circle"></div>
                </div>
            </div>
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
    <p v-if="!isMobile" class="more">
        Voir plus...
    </p>
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

    .day-date {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    
    .day {
        font-size: 1rem;
        line-height: 1rem;
    }

    .date-circles {
        display: flex;
        flex-direction: column;
    }

    .date {
        font-size: 1.5rem; 
        line-height: 1.5rem;
        margin: .3rem 0;
        font-weight: 900;
    }

    .circles {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .task-circle, .course-circle {
        width: .7rem;
        height: .7rem;
        margin: 0 .1rem .1rem .1rem;
        background-color: var(--brown);
        border-radius: 5rem;
    }

    .course-circle {
        background-color: var(--beige);
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
            line-height: 1.1rem;
        }

        .date {
            font-size: 1.8rem;
            line-height: 1.8rem;
        }

        .task-circle, .course-circle {
            width: .8rem;
            height: .8rem;
            margin: 0 .15rem .15rem .15rem;
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
            flex-direction: row;
            flex-wrap: wrap;
        }

        .day {
            margin-bottom: .3rem;
        }

        .hr-date {
            border-top: 3px solid var(--green);
            opacity: 1;
            margin: .1rem 0;
        }

        .today .hr-date {
            border-color: var(--orange);
        }

        .date-circles {
            width: 100%;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
        }

        .course-circle, .task-circle {
            margin-bottom: 0;
            width: 1rem;
            height: 1rem;

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

        .more {
            text-decoration: underline;
            text-align: end;
            text-underline-offset: 2px;
        }

    }
</style>

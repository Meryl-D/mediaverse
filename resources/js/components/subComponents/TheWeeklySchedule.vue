<script setup>
    import BaseDay from './BaseDay.vue'
    import BaseBox from './BaseBox.vue'
    import { onMounted, ref, watchEffect } from 'vue'
    import { chunkArrayInGroups, isMobile } from '../../stores.js'

    const props = defineProps({
        schedule : {
            type : Array,
            required : true
        },
        today : {
            type : Object,
            required : true
        },
        nextMonday : {
            type : String,
            required : true
        },
        isMobile : {
            type : Boolean,
            required : true
        },
        tasks : {
            type : Object,
            required : true
        }
    });

    const weeksSchedule = chunkArrayInGroups(props.schedule, 5)
    let currWeekIndex = null;

    // Get the index of the current week when today is a week day
    for (let i = 0; i < weeksSchedule.length; i++) {
            if (weeksSchedule[i].some(day => day.fullDate == props.today.fullDate)) currWeekIndex = i
    }

    // Get the index of next week when today is a week-end day
    if (currWeekIndex == null) {
        for (let i = 0; i < weeksSchedule.length; i++) {
            if (weeksSchedule[i].some(day => day.fullDate == props.nextMonday)) currWeekIndex = i
        }
    }

    // scroll to current week once the app is mounted
    onMounted(() => {
        const currWeek = (document.getElementsByClassName('curr-week'))[0]
        currWeek.scrollIntoView({ block: "nearest", inline: "nearest" })
    })
</script>

<template>
<section class="weekly-schedule">
    <header v-if="!isMobile" class="weekly-header">
        <h1>Horaires et tâches</h1>
        <h2>{{today.month}} {{today.year}}</h2>
    </header>

    <main class="weekly-main">
        <base-box class="week-box">
            <div 
                v-for="(week, i1) in weeksSchedule" 
                :key="week" class="week-ctn" 
                :class="{ 'curr-week' : i1 == currWeekIndex}"
            >
                <div 
                    v-for="(lessonDay, i2) in week" 
                    :key="lessonDay" 
                    class="day-ctn"
                >
                    <base-day 
                        :lessonDay="lessonDay"
                        :today="props.today"
                        :isMobile="isMobile"
                        :tasks="props.tasks"
                    >
                    </base-day>
                    <hr v-if="i2 + 1 != week.length && isMobile" class="sep">
                </div>
            </div>
        </base-box>
    </main>
</section>
</template>

<style scoped>

    .weekly-schedule {
        display: flex;
        flex-direction: column;
        align-items: center;
        height: calc(100vh - 6rem)

    }

    .weekly-header {
        padding-top: 2.5rem;
        height: 7rem;
        width: 90%;
        display: flex;
        align-items: baseline;
        justify-content: space-between;
    }

    .weekly-header h2 {
        color: var(--orange);
    }

    .weekly-main {
        width: 100%;
        height: calc(100% - 6vw - .3rem);
        display: flex;
        justify-content: center;
        margin-top: .3rem;
    }
    .week-box {
        -ms-overflow-style: none; /* for Internet Explorer, Edge */
        scrollbar-width: none; /* for Firefox */
        overflow-y: scroll;
        /* height: calc(100% - 7vw); */
        scroll-snap-type: y mandatory;
    }

    .week-box::-webkit-scrollbar {
        display: none; /* for Chrome, Safari, and Opera */
    }

    .week-ctn {
        flex-basis: 100%;
        height: 100%;
        display: grid;
        grid-template-rows: repeat(5, 1fr);
        grid-auto-rows: 1fr;
        scroll-snap-align: start;
    }

    .day-ctn {
        display: flex;
        flex-direction: column;
        cursor: pointer;
    }

    .sep {
        height: 0;
        margin : 0;
        border: none;
        border-top: 2px solid #b8b8b8;
        background-color: transparent;
        width: calc(100% - 4rem);
        align-self: center;
    }

    @media (min-width: 992px) {
        .weekly-schedule {
            height: 100%;
        }

        .weekly-main {
            height: calc(100vh - 7.3rem);
        }


        .week-box {
            height: calc(100% - 6vh);
            gap: 2rem;
        } 

        .week-ctn {
            grid-template-rows: none;
            grid-template-columns: repeat(5, 1fr);
            grid-column-gap: 2rem;
            height: calc(50% - 1rem);
        }

        .lesson-ctn {
            flex-direction: column;
            padding: 0; 
        }

    }
</style>
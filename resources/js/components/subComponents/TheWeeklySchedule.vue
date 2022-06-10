<script setup>
    import BaseDay from './BaseDay.vue'
    import { onMounted, ref, watchEffect } from 'vue'
    import { chunkArrayInGroups } from '../../stores.js'

    const props = defineProps({
        schedule : {
            type : Array,
            required : true
        },
        today : {
            type : String,
            required : true
        }
    });

    const weeksSchedule = chunkArrayInGroups(props.schedule, 5)
    let currWeekIndex = 0;

    for (let i = 0; i < weeksSchedule.length; i++) {
            if (weeksSchedule[i].some(day => day.fullDate == props.today)) currWeekIndex = i
    }

    onMounted(() => {
        const currWeek = (document.getElementsByClassName('currWeek'))[0]
        currWeek.scrollIntoView()
    })

</script>

<template>
<div class="week-box">
    <div 
        v-for="(week, i1) in weeksSchedule" 
        :key="week" class="week-ctn" 
        :class="{ 'currWeek' : i1 == currWeekIndex}"
    >
        <div 
            v-for="(lessonDay, i2) in week" 
            :key="lessonDay" 
            class="day-ctn"
        >
            <base-day 
                :lessonDay="lessonDay"
                :today="props.today"
            >
            </base-day>
            <hr v-if="i2 + 1 != week.length" class="sep">
        </div>
    </div>
</div>
</template>

<style scoped>
    /* hide scrollbar but allow scrolling */
    .week-box {
        border: thin solid black;
        -ms-overflow-style: none; /* for Internet Explorer, Edge */
        scrollbar-width: none; /* for Firefox */
        overflow-y: scroll;
        height: 90vh;
        scroll-snap-type: y mandatory;
    }

    .week-box::-webkit-scrollbar {
        display: none; /* for Chrome, Safari, and Opera */
    }

    .week-ctn {
        height: 100%;
        display: grid;
        grid-template-rows: repeat(5, 1fr);
        grid-auto-rows: 1fr;
        scroll-snap-align: start;
    }

    .day-ctn {
        display: flex;
        flex-direction: column;
    }

    .sep {
        margin: 0;
        padding: 0;
        height: 0;
        border: none;
        border-top: 1px solid #6e6e6e;
        background-color: transparent;
        width: calc(100% - 4rem);
        align-self: center;
    }
</style>
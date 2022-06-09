<script setup>
    import BaseDay from './BaseDay.vue'
    import { ref } from 'vue'
    import { chunkArrayInGroups } from '../../stores.js'

    const props = defineProps({
        schedule : {
            type : Array,
            required : true
        }
    });

    console.log(props.schedule)
    const weeksSchedule = ref(chunkArrayInGroups(props.schedule, 5))
</script>

<template>
<div v-for="week in weeksSchedule" :key="week" class="week-ctn">
    <div v-for="lessonDay in week" :key="lessonDay">
        <base-day :lessonDay="lessonDay">
        </base-day>
    </div>
</div>
</template>

<style scoped>

</style>
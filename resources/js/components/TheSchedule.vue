<script setup>
    import { ref, watchEffect } from 'vue';
    import { axiosClient } from '../utils/axios.js';
    import { user } from '../stores.js';
    import TheWeeklySchedule from './subComponents/TheWeeklySchedule.vue';
    import TheDailySchedule from './subComponents/TheDailySchedule.vue'

    const { data } = await axios.get('/api/lessons', {
        headers: { Authorization : `Bearer ${user.value.token}` }
    });

    //console.log(data)

</script>

<template>
    <!-- <the-weekly-schedule :content="data.weekDaysSchedule"></the-weekly-schedule> -->
    <the-daily-schedule :days="data.allDaysSchedule"></the-daily-schedule>
    <the-weekly-schedule :schedule="data.weekDaysSchedule"></the-weekly-schedule>
</template>

<style scoped>

</style>

<script setup>
    import { ref, watchEffect } from 'vue';
    import { axiosClient } from '../utils/axios.js';
    import { user } from '../stores.js';
    import TheWeeklySchedule from './subComponents/TheWeeklySchedule.vue';
    import TheMonthlySchedule from './subComponents/TheMonthlySchedule.vue';

    const { data } = await axios.get('/api/lessons', {
        headers: { Authorization : `Bearer ${user.value.token}` }
    });

</script>

<template>
    <the-weekly-schedule 
    :schedule="data.weekDaysSchedule"
    :today="data.today"
    >
    </the-weekly-schedule>
    <!-- <the-monthly-schedule :schedule="data.allDaysSchedule"></the-monthly-schedule> -->
</template>

<style scoped>

</style>

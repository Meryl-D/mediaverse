<script setup>
    import { ref, watchEffect } from 'vue';
    import { axiosClient } from '../utils/axios.js';
    import { user } from '../stores.js';
    import TheWeeklySchedule from './subComponents/TheWeeklySchedule.vue';

    const { data } = await axios.get('/api/lessons', {
        headers: { Authorization : `Bearer ${user.value.token}` }
    });

    //console.log(data)

</script>

<template>
    <the-weekly-schedule :schedule="data.weekDaysSchedule"></the-weekly-schedule>
</template>

<style scoped>

</style>

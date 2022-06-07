<script setup>
    import { ref, watchEffect } from 'vue';
    import { axiosClient } from '../utils/axios.js';

    const { data } = await axiosClient.get('/api/lessons')
    // .catch(function (error) {
    //     console.error(error);
    // });
    data.lessons.forEach(lesson => {
        //data.lessons.map(course_id => lesson.course)
    });

</script>

<template>
    
</template>

<style scoped>

</style>

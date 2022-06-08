<script setup>
    import { ref, watchEffect } from 'vue';
    import { axiosClient } from '../utils/axios.js';

    const { data } = await axiosClient.get('/api/lessons')
    // .catch(function (error) {
    //     console.error(error);
    // });
    // function replaceCourseIdByName(data) {

    //     data.lessons.forEach(lesson => {
    //     const course = data.courses.find(course => course.id === lesson.course_id);
    //     lesson.course = course.name;
    //     delete lesson.course_id;
    //     });    
    // }

    // replaceCourseIdByName(data)

    console.log(data)

</script>

<template>
    <div v-for="lesson in data.lessons" :key="lesson.id">
        <base-lesson
           :name="lesson.name"
        >
        </base-lesson>
    </div>
</template>

<style scoped>

</style>

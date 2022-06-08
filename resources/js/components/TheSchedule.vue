<script setup>
    import { ref, watchEffect } from 'vue';
    import { axiosClient } from '../utils/axios.js';
    import { user } from '../stores.js';

    const { data } = await axios.get('/api/lessons', {
        headers: { Authorization : `Bearer ${user.value.token}` }
    });

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

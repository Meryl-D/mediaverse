<script setup>
    import { ref, watchEffect } from 'vue';
    import { axiosClient } from '../utils/axios.js';

    const { data } = await axiosClient.get('/api/lessons')
    // .then(response => {
    //     //console.log(response.data)
    //     data.value = response.data;
    // })
    // .catch(function (error) {
    //     console.error(error);
    // });
    console.log(data);

</script>

<template>
    
</template>

<style scoped>

</style>

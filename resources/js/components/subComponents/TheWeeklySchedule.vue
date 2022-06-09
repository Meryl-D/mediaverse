<script setup>
    import BaseDay from './BaseDay.vue';

    const props = defineProps({
        schedule : {
            type : Object,
            required : true
        }
    });
</script>

<template>
    <div v-for="lessonDay in props.schedule" :key="lessonDay">
        <base-day :lessonDay="lessonDay">
        </base-day>
    </div>
</template>

<style scoped>

</style>
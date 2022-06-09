<script setup>
    import BaseDay from './BaseDay.vue';

    const props = defineProps({
        schedule : {
            type : Object,
            required : true
        }
    });

    console.log(props.schedule)
</script>

<template>
    <div v-for="lessonDay in props.schedule" :key="lessonDay.id">
        <base-day :lessonDay="lessonDay">
        </base-day>
    </div>
</template>

<style scoped>

</style>
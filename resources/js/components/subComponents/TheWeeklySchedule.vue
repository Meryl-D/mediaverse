<script setup>

</script>

<template>
    <div v-for="lesson in data.weekDaysSchedule" :key="lesson.id">
        <base-day :content="lesson">
        </base-day>
    </div>
</template>

<style scoped>

</style>
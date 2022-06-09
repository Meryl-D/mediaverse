<script setup>
import BaseDay from './BaseDay.vue'

</script>

<template>
      <div v-for="day in data.allDaysSchedule" :key="day.id">
        <base-day :content="day">
        </base-day>
    </div>
</template>





<style scoped>

</style>
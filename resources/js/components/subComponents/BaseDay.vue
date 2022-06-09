<script setup>
    const props = defineProps({
        content : {
            type : Object,
            required : true
        }
    });
</script>

<template>
    <div class="lesson-ctn">
        <div class="date-ctn">
            <p class="day">
                {{ content.dayShort }}
            </p>
            <p class="date">
                {{ content.date }}
            </p>
        </div>
        <div v-for="course in content" :key="course" class="course-ctn">
            <p class="course-name">
                {{ content.name }}
            </p>
            <p class="course-time">
                {{ content.timeStart }}-{{ content.timeEnd }}
            </p>
        </div>
    </div>
</template>

<style scoped>

</style>

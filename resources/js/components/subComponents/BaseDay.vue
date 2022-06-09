<script setup>
    const props = defineProps({
        lessonDay : {
            type : Object,
            required : true
        }
    });
</script>

<template>
    <div class="lesson-ctn">
        <div class="date-ctn">
            <p class="day">
                {{ props.lessonDay.dayShort }}
            </p>
            <p class="date">
                {{ props.lessonDay.date }}
            </p>
        </div>
        <!-- <div v-for="course in lesson" :key="course" class="course-ctn">
            <p class="course-name">
                {{ props.lessonDay.name }}
            </p>
            <p class="course-time">
                {{ props.lessonDay.timeStart }}-{{ props.lessonDay.timeEnd }}
            </p>
        </div> -->
    </div>
</template>

<style scoped>

</style>

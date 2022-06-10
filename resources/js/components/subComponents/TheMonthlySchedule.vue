
<script setup>
    import BaseCourse from './BaseCourse.vue';
    import TheHeaderMobil from './TheHeaderMobil.vue';

    const props = defineProps({
        schedule : {
            type : Object,
            required : true
        }
    });

    // console.log(props.schedule)
</script>


<template>
    <div v-for="lesson in props.schedule" :key="lesson.id">
        <base-course :lessonDay="lesson">
        </base-course>
    </div>
</template>

<style scoped>

</style>
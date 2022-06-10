
<script setup>
import BaseCourse from './BaseCourse.vue';
import TheHeaderMobile from './TheHeaderMobile.vue';
import TheTasks from './TheTasks.vue';

const props = defineProps({
    schedule: {
        type: Object,
        required: true
    }
});

const props = defineProps({
  schedule: {
    type: Object,
    required: true,
  },
  days: {
    type: Object,
    required: true,
  },
  today: {
    type: String,
    required: true,
  },
});

//-------------------------------------------------------------------------------------------------

//reactive variable for day selected with the date of the day
const currentDate = ref("");
props.days.forEach((d) => {
  if (d.fullDate == props.today) {
    currentDate.value =
      d.dayLong + ", " + d.date + " " + d.month.toLowerCase() + " " + d.year;
  }
});

//event listener for day choose
function getDay(d) {
  currentDate.value =
    d.dayLong + ", " + d.date + " " + d.month.toLowerCase() + " " + d.year;
  console.log(d);
}
//-------------------------------------------------------------------------------------------------

//put 7 days together
const weeksSchedule = chunkArrayInGroups(props.days, 30);
console.log(weeksSchedule);
</script>


<template>
  <div id="file">
    <div id="calendar">
      <vue-cal
        :time="false"
        hide-weekends
        style="height: 500px"
        active-view="month"
        :disable-views="['years', 'year', 'week', 'day']"
        hide-view-selector
        class="vuecal--rounded-theme"
        locale='fr'
      />
    </div>
  </div>
  <div v-for="lesson in props.schedule" :key="lesson.id">
    <base-course :lessonDay="lesson"> </base-course>
  </div>
</template>

<style scoped>
</style>
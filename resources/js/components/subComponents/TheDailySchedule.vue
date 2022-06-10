<script setup>
import { chunkArrayInGroups } from "../../stores.js"
import { computed, ref } from "vue"

//-------------------------------------------------------------------------------------------------

const props = defineProps({
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
const currentDate = ref("")
props.days.forEach((d) => {
  if (d.fullDate == props.today) {
    currentDate.value = d.dayLong + ", " + d.date + " " + d.month.toLowerCase() + " " + d.year;
  }
});

//event listener for day choose
function getDay(d){
    currentDate.value = d.dayLong + ", " + d.date + " " + d.month.toLowerCase() + " " + d.year;
    console.log(d)
}

//-------------------------------------------------------------------------------------------------

//put 7 days together
const weeksSchedule = chunkArrayInGroups(props.days, 7);
console.log(weeksSchedule);


</script>

<template>
  <div id="file">
    <div id="calendar">
      <div v-for="group in weeksSchedule" :key="group" class="week">
        <div v-for="day in group" :key="day" class="day"  @click="getDay(day)">
          <p>{{ day.dayShort }}</p>
          <p>
            <strong>{{ day.date }}</strong>
          </p>
        </div>
      </div>
    </div>
    <div>
      <p class="choosenDay">
        <strong>{{ currentDate }}</strong>
      </p>
    </div>
    <hr />
  </div>
</template>


<style scoped>

#calendar {
  display: flex;
  /* flex-direction: column; */
  overflow-y: auto;
  -ms-overflow-style: none; /* for Internet Explorer, Edge */
  scrollbar-width: none; /* for Firefox */
  height: 15vh; 
}

#calendar::-webkit-scrollbar {
  display: none; /* for Chrome, Safari, and Opera */
}

.week {
  display: contents;
  flex-direction: row;
  /* justify-content: space-between;  */

   /* width: 100vw;  */
   background-color: black;
}
.day {
  height: 80%;
  margin-right: 3%;
  margin-left: 3%;
  margin-top: 1%;
  cursor: pointer;
}
.select{
  color: var(--orange);
}
.choosenDay {
  text-align: center;
}
hr {
  color: var(--orange);
  margin: 0%;
}

</style>
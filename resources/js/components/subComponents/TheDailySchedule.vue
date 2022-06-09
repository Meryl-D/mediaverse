<script setup>
const props = defineProps({
  days: {
    type: Object,
    required: true,
  },
});



console.log(props.days);
</script>

<template>
  <div id="file">
    <div id="header">
      <div id="week">
        <div v-for="day in props.days" :key="day.id" class="day">
          <p>{{ day.dayShort }}</p>
          <p>
            <strong>{{ day.date }}</strong>
          </p>
        </div>
      </div>
      <p class="choosenDay">
        <strong>Date du jour{{}}</strong>
      </p>
    </div>
    <hr />
  </div>
</template>


<style scoped>
#file {
  display: flex;
  flex-direction: column;
}
#week {
  display: flex;
  flex-direction: row;
}
.day {
  margin: 2%;
}
.choosenDay {
  text-align: center;
}
hr {
  color: var(--orange);
}
</style>
<script setup>
const props = defineProps({
  today: {
    type: String,
    required: true,
  },
});

console.log(props.today);

function createDate(currentDay){
  let hour =  Date(2018, 8, 22, 15, 0, 0).toString("MMMM dS, yyyy");
  return hour
}

let uneDate = createDate(props.today)
console.log(uneDate)

</script>

<template>
  <div id="container">
    <div class="time"></div>
    <div class="task">{{uneDate}}</div>
  </div>
</template>

<style scoped>
#container {
  background-color: var(--white);
}
hr {
  color: black;
}
</style>
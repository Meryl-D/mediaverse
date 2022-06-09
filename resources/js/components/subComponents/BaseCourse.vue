<script setup>
import BaseBox from "./BaseBox.vue";
const props = defineProps({
  lessonDay: {
    type: Object,
    required: true,
  },
});
console.log(props.lessonDay);
</script>

<template>
  <base-box >
    <div id="fill">
      <p class="p">
        {{ props.lessonDay }}
      </p>
    </div>
  </base-box>
</template>

<style scoped>
#file {
  display: flex;
  flex-direction: column;
  padding: 1%;
  width: 80%;
}
</style>

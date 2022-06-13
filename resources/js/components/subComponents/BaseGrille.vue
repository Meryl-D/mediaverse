<script setup>
import BaseCourse from "./BaseCourse.vue";
import TheTasks from "./TheTasks.vue";
import { ref, onMounted } from "vue";
import { watchEffect } from "vue";
import { selectedTasks } from "../../stores.js";

const props = defineProps({
  day: {
    type: Object,
    required: true,
  },
});

const taskRefs = ref([]);

const pos = {};

onMounted(() => {
  for (let i = 0; i < selectedTasks.value.length; i++) {
    const line = document.getElementsByClassName(
      selectedTasks.value[i].hourStart
    )[0];

  console.log(taskRefs.value);

    //console.log(line)

    const simpleLine = line.getElementsByClassName("hr")[0];
    const lineRect = simpleLine.getBoundingClientRect();
    const lineTop = lineRect.top;

    const task = document.getElementsByClassName("task-" + (i + 1));
    console.log(task)
   const course = document.getElementsByClassName("course-ctn")
}
});
</script>

<template>
  <div class="grid">
    <div v-for="n in 16" :key="n" class="container">
      <div v-if="n < 3" class="hour">0{{ n + 7 }}:00</div>
      <div v-if="n >= 3" class="hour">{{ n + 7 }}:00</div>
      <div v-if="n < 3" class="line" :class="`0${n + 7}`">
        <hr class="hr" />
      </div>
      <div v-if="n >= 3" class="line" :class="`${n + 7}`">
        <hr class="hr" />
      </div>
    </div>
  </div>

  <the-tasks :day="props.day" class="task" ref="taskRefs"></the-tasks>
  <base-course :lessonDay="props.day"> </base-course>
</template>

<style scoped>
.grid {
  display: grid;
  /* grid-template-columns: 4% 96%;
  grid-row-gap: 0.5%;
  grid-column-gap: 1%; */
  margin-left: 6.5%;
  margin-right: 6%;
}
.container {
  display: flex;
  flex-direction: row;
}

.hour {
  flex: 1;
}

.line {
  flex: 10;
}

.s {
  display: flex;
  align-items: center;
  justify-content: flex-start;
}

hr {
  color: gray;
  height: 0;
  border: none;
  border-top: 2px solid gray;
  background-color: transparent;
}
</style>
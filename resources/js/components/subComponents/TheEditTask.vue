<script setup>
import BaseButton from "./BaseButton.vue";
import { watch, ref, onMounted, watchEffect } from "vue";
import { axiosClient } from "../../utils/axios.js";
import router from "../../router/index.js";

const props = defineProps({
  task: {
    type: Object,
    required: true,
  },
});

console.log(props.task);
const emit = defineEmits(["close", "add"]);

const nameTask = ref(props.task.name);
const dateStartTask = ref(
  new Date(props.task.dateStart)
    .toISOString()
    .substring(0, new Date(props.task.dateStart).toISOString().length - 1)
);
const dateEndTask = ref(
  new Date(props.task.dateEnd)
    .toISOString()
    .substring(0, new Date(props.task.dateEnd).toISOString().length - 1)
);
const descriptionTask = ref(props.task.description);

const errorMsg = ref("");

async function editTask() {
  let task = {
    name: nameTask.value,
    dateStart: dateStartTask.value,
    dateEnd: dateEndTask.value,
    description: descriptionTask.value,
    id: props.task.id,
  };
  console.log("tâche modifiée", task);
  const url = "api/tasks/update";
  await axiosClient.post(url, task);
}

async function submitForm() {
  try {
    await editTask();
    location.reload();
    // emit("add");
    // router.push({
    //   name: "Horaires",
    // });
  } catch (err) {
    // errorMsg.value = err.response.data.error;
  }
}

async function deleteTask() {
  let idTask = props.task.id;

  const urlDelete = "api/tasks/delete/" + idTask;
  console.log(urlDelete);
  await axiosClient.delete(urlDelete);
}

async function deleteTaskForm() {
  try {
    await deleteTask();
    location.reload();
    // emit("add");
    // router.push({
    //   name: "Horaires",
    // });
  } catch (err) {
    // errorMsg.value = err.response.data.error;
  }
}

console.log(props.task);
</script>
<template>
  <div class="file">
    <div class="header">
      <h2>Tâche</h2>
      <div class="icone">
        <link
          rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"
        />
        <span class="material-symbols-outlined" @click="$emit('close')">
          close
        </span>
      </div>
    </div>
    <form @submit.prevent="submitForm()" class="form">
      <div id="left">
        <input v-model="nameTask" type="text" class="basic name" />
        <div id="time">
          <div class="dateStart">
            <input v-model="dateStartTask" type="datetime-local" class="dateTask" />
          </div>
          <hr />
          <div class="dateEnd">
            <input v-model="dateEndTask" type="datetime-local" class="dateTask" />
          </div>
          <!-- <hr />
          <input
            v-model="categorieTask"
            type="label"
            class="date"
            placeholder="Catégorie"
          /> -->
        </div>
      </div>
      <div id="right">
        <textarea
          v-model="descriptionTask"
          class="basic description"
          placeholder="Description"
          style="padding: 1rem"
        />

        <p v-if="errorMsg" class="error">
          {{ errorMsg }}
        </p>
        <div id="btn-add-task">
          <base-button type="submit" class="btn">Modifier</base-button>
        </div>
      </div>
    </form>
    <div id="btn-delete-task">
      <button type="submit" class="delete" @click="deleteTaskForm">
        Supprimer
      </button>
    </div>
  </div>
</template>

<style>
.file {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  background-color: white;
  border-radius: 0.7rem;
  padding-top: 3%;
  padding-bottom: 4%;
  /* margin-top: 12%; */
}
.header {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  width: 100%;
  margin-bottom: 0.5rem;
  padding-left: 1rem;
  padding-right: 1rem;
}
h2 {
  font-weight: bold;
}

.name {
  height: 3rem;
  margin-bottom: 1rem;
}

.dateTask {
  background-color: transparent;
  border: none;
  outline: none;
  padding-right: 1rem;
  width: 100%;
  /* padding: 2rem; */
}

#right {
  align-items: right;
}

#btn-add-task {
  display: flex;
  justify-content: right;
  width: 100%;
}
#btn-delete-task {
  display: flex;
  justify-content: flex-end;
  width: 100%;
  margin-top: 1rem;
  padding-right: 1rem;
  margin-bottom: 3rem;
}
.btn {
  width: 30%;
}
.delete {
  width: 15%;
  color: var(--green);
  background-color: var(--white);
  border: none;
  border-radius: var(--small-radius);
  box-shadow: var(--shadow);
  padding: 0.3rem 0.9rem;
}
.delete:hover,
.delete:active {
  color: var(--orange);
}
.material-symbols-outlined {
  color: var(--orange);
  filter: drop-shadow(0 0 0.75rem var(--orange));
  cursor: pointer;
}
input:focus {
  outline: 2px solid #e3cec2;
}
hr {
  height: 0;
  width: 97%;
  border: none;
  border-top: 2px solid white;
  background-color: transparent;
}

@media (max-width: 992px) {
  .file {
    margin-top: 0;
  }
  form {
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }
  .header {
    margin-top: 1rem;
  }
  .basic {
    width: 100%;
    /* margin: 1rem; */
    border-radius: 0.7rem;
    border: solid 0.1rem #e3cec2;
    opacity: 50%;
  }
  .name {
    height: 3rem;
    margin: 0;
    margin-top: 1rem;
    margin-bottom: 1rem;
  }
  .description {
    height: 9rem;
    margin: 0;
    margin-bottom: 2rem;
    /* margin-bottom: 5rem; */
  }
  #time {
    display: flex;
    flex-direction: column;
    width: 100%;
    height: 9rem;
    margin: 0;
    background-color: #e3cec2;
    opacity: 50%;
    /* justify-content: center; */
    border-radius: 0.6rem;
    margin-bottom: 1rem;
  }
  #right {
    align-items: center;
    padding-left: 1rem;
    padding-right: 1rem;
  }
  #left {
    display: flex;
    flex-direction: column;
    padding-left: 1rem;
    padding-right: 1rem;
  }
  #btn-add {
    display: flex;
    width: 100%;
    margin-bottom: 3rem;
    padding: 0;
  }

  .btn {
    width: 100%;
    margin: 0;
  }
  #btn-delete-task {
    display: flex;
    width: 90%;
    justify-content: center;
    padding: 0;
  }
  .delete {
    width: 100%;
  }
}
</style>
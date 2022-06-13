<script setup>
import BaseButton from "./BaseButton.vue";
import { watch, ref, onMounted } from "vue";
import { axiosClient } from "../../utils/axios.js";
const emit = defineEmits(["close"]);

let newTask = {
  name: "",
  dateStart: "",
  dateEnd: "",
  description: "",
  user_id: 1,
};

const errorMsg = ref("");
async function addTask() {
  await axiosClient.post("api/tasks/add", newTask);
}

async function submitForm() {
  try {
    await addTask();
    router.push({
      name: "Horaires",
    });
  } catch (err) {
    // errorMsg.value = err.response.data.error;
  }
}

const name = ref("");
const description = ref("");
</script>
<template>
  <div class="file">
    <div class="header">
      <h2>Nouvelle tâche</h2>
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
    <form @submit.prevent="submitForm()">
      <div class="form">
        <input
          v-model="name"
          type="text"
          class="input basic name"
          placeholder="Nom"
        />
        <div id="time">
          <input type="datetime-local" class="input type" placeholder="Type" />
          <hr />
          <input type="datetime-local" class="input type" placeholder="Type" />
          <hr />
          <input type="label" class="input type" placeholder="Catégorie" />
        </div>
        <input
          v-model="description"
          type="text"
          class="input basic description"
          placeholder="Description"
        />
      </div>
      <p v-if="errorMsg" class="error">
        {{ errorMsg }}
      </p>
      <div id="btn-add">
        <base-button type="submit" class="btn">Ajouter</base-button>
      </div>
    </form>
  </div>
</template>

<style>
.file {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  background-color: var(--white);
  border-radius: 0.3rem;
  padding-top: 5%;
}
.header {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  width: 95%;
  margin-bottom: .5rem;
}
h2 {
  font-weight: bold;
}
form {
  width: 100%;
}
.form {
  display: flex;
  flex-direction: column;
  width: 100%;
  align-items: center;
}
#time {
  width: 95%;
  background-color: #e3cec2;
  opacity: 50%;
  justify-content: center;
  border-radius: 0.3rem;
}
::placeholder {
  color: black;
}
#btn-add {
  width: 100%;
  text-align: center;
}
.btn {
  width: 95%;
  margin-bottom: 15%;
}
.material-symbols-outlined {
  color: var(--orange);
  filter: drop-shadow(0 0 0.75rem var(--orange));
  cursor: pointer;
}

.basic {
  background-color: #e3cec2;
  opacity: 50%;
  border-radius: 0.3rem;
  border: none;
  padding: 2rem;
  margin: 0.5rem;
  width: 95%;
}
.name {
  height: 1rem;
}
.description {
  height: 3rem;
}
.type {
  background-color: transparent;
  border: none;
  padding: 2rem;
}
hr {
  height: 0;
  width: 100%;
  border: none;
  border-top: 2px solid white;
  background-color: transparent;
}
</style>
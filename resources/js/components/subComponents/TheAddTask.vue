<script setup>
import BaseButton from "./BaseButton.vue";
</script>
<template>
  <div class="file">
    <div class="header">
      <h1>Nouvelle tâche</h1>
      <div class="icone">
        <link
          rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"
        />
        <span class="material-symbols-outlined md-48"> close </span>
      </div>
    </div>
    <div class="form">
      <input type="text" class="input basic name" placeholder="Nom" />
      <div id="time">
        <input type="date" class="input type" placeholder="Type" />
        <hr />
        <input type="date" class="input type" placeholder="Type" />
        <hr />
        <input type="label" class="input type" placeholder="Type" />
      </div>
      <input
        type="text"
        class="input basic description"
        placeholder="Description"
      />
    </div>

    <div id="btn-add">
      <base-button type="send" class="btn">Ajouter</base-button>
    </div>
  </div>
</template>

<style>
.file {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}
.header {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  width: 80%;
  margin-bottom: 3rem;
}
h1 {
  font-weight: bold;
}
.form {
  display: flex;
  flex-direction: column;
  width: 100%;
  align-items: center;
}
#time {
  width: 80%;
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
  width: 80%;
}
.material-symbols-outlined {
  color: var(--orange);
  filter: drop-shadow(0 0 0.75rem var(--orange));
  cursor: pointer;
}
.icone {
}
.basic {
  background-color: #e3cec2;
  opacity: 50%;
  border-radius: 0.3rem;
  border: none;
  padding: 2rem;
  margin: 0.5rem;
  width: 80%;
}
.name {
  height: 2rem;
}
.description {
  height: 10rem;
}
.type {
  height: 2rem;
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
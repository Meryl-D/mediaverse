<script setup>
import { axiosClient } from "../../utils/axios.js";
import { user } from "../../stores.js";
import router from '../../router/index.js';
import BaseButton from "./BaseButton.vue";


const creds = {
  email : '',
  password : ''
}

async function login() {
  await axiosClient.get('/sanctum/csrf-cookie');
  const { data } = await axiosClient.post('api/login', creds);
  console.log(data)

  user.value={
    id : data.id,
    firstName : data.firstName,
    lastName : data.lastName,
    token : data.token,
  };
}

async function submitForm() {
  await login();
  router.push({
    name : 'Horaires'
  })
}
</script>

<template>
  <form @submit.prevent="submitForm()">
    <div>
      <label for="email">Adresse e-mail</label>
      <input id="email" type="email" v-model="creds.email" required />
    </div>
    <div>
      <label for="password">Mot de passe</label>
      <input id="password" type="password" v-model="creds.password" required />
    </div>
   <!-- <button type="submit">Envoyer</button>-->
    <base-button type="submit">Envoyer</base-button>
  </form>
</template>
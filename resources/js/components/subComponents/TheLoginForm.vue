<script setup>
import { ref } from 'vue';
import { axiosClient } from "../../utils/axios.js";
import { user } from "../../stores.js";
import router from "../../router/index.js";
import BaseButton from "./BaseButton.vue";
import BaseBox from "./BaseBox.vue";

const creds = {
  email: "",
  password: "",
};

const errorMsg = ref('');

async function login() {
  await axiosClient.get('/sanctum/csrf-cookie');
  const { data } = await axiosClient.post('api/login', creds);

  user.value = {
    firstName: data.firstName,
    lastName: data.lastName,
    role: data.role,
    token: data.token,
  };
}

async function submitForm() {

  try {
    await login();
    router.push({
      name: "Horaires",
    });
  } catch (err) {
    errorMsg.value = err.response.data.error
  }
}
</script>

<template>
  <base-box>
    <form @submit.prevent="submitForm()">
      <div>
        <label for="email">Adresse e-mail</label>
        <input id="email" type="email" v-model="creds.email" required />
      </div>
      <div>
        <label for="password">Mot de passe</label>
        <input
          id="password"
          type="password"
          v-model="creds.password"
          required
        />
      </div>
      <p v-if="errorMsg">
        {{ errorMsg }}
      </p>
      <base-button type="submit">Envoyer</base-button>
    </form>
  </base-box>
</template>
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
    id: data.id,
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
    <form @submit.prevent="submitForm()">
      <div class="input-box">
        <label for="email">Adresse e-mail</label>
        <input id="email" type="email" v-model="creds.email" required />
      </div>
      <div class="input-box">
        <label for="password">Mot de passe</label>
        <input
          id="password"
          type="password"
          v-model="creds.password"
          required
        />
      </div>
      <p v-if="errorMsg" class="error">
        {{ errorMsg }}
      </p>
      <base-button type="submit" class="btn-login">Envoyer</base-button>
    </form>
</template>

<style scoped>
  .input-box {
    display: flex;
    flex-direction:column;
  }

  input {
    border: 2px solid var(--beige);
    border-radius: var(--small-radius);
    margin-bottom: 1rem;
    height: 2rem;
    padding: .3rem;
  }

  input:focus {
    outline: 2px solid var(--orange);
  }

  .btn-login {
    align-self: end;
    margin-top: 1rem;
  }

  input:-webkit-autofill {
    background-color: transparent !important;
    -webkit-box-shadow: 0 0 0 50px var(--white) inset;
  }

</style>
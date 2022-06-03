<script setup>
    import axios from "axios";
    import { ref, watchEffect } from 'vue';
    import { auth } from '../../stores.js';

    const email = ref('');
    const password = ref('');
    const error = ref(null);

    function login() {
        if (!password) return;

        axios.get('/sanctum/csrf-cookie').then(response => {
            
            axios.post('api/login', {
                email: email.value,
                password: password.value
            })
            .then(response => {
                console.log(response.data)
                if (response.data.success) {
                    window.location.hash = '#'
                    auth.value = true;
                } else {
                    error.value = response.data.message
                }
            })
            .catch(function (error) {
                console.error(error.value)
            });
        })
    }

</script>

<template>
    <form @submit.prevent="login()">
        <div>
            <label for="email">Adresse e-mail</label>
            <input id="email" type="email" v-model="email" required>
        </div>
        <div>
            <label for="password">Mot de passe</label>
            <input id="password" type="password" v-model="password" required>
        </div>
        <button type="submit">Envoyer</button>
    </form>
</template>
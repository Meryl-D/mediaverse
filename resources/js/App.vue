<script setup>
    import {ref} from 'vue';
    import axios from 'axios';

	// const message = ref('hello from vue');
	// const message2 = ref(data);

	// fetch('/api/test').then(
	// 	resp => resp.json()
	// ).then(
	// 	test => console.log(test)
	// )
    const isLoggedIn = ref('false');

    if (window.Laravel.isLoggedin) {
        this.isLoggedIn = true
    }

    function logout(e) {
            console.log('ss')
            e.preventDefault()
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/api/logout')
                    .then(response => {
                        if (response.data.success) {
                            window.location.href = "/"
                        } else {
                            console.log(response)
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        }
</script>


<template>
    <!-- <h1>
        {{ message }}
    </h1> -->
    <!-- <h2>
         {{message2}}
    </h2> -->
    <div class="container">
        <div>
            <div>
                <!-- for logged-in user-->
                <div v-if="isLoggedIn">
                    <!-- <a class="nav-item nav-link" style="cursor: pointer;" @click="logout">Logout</a> -->
                </div>
                <!-- for non-logged user-->
                <div v-else>
                    <!-- un super formulaire -->
                </div>
            </div>
        </div>
    </div>
</template>
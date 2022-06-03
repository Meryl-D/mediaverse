<script setup>
import { ref } from "vue";
import axios from "axios";
import TheSchedule from './components/TheSchedule.vue'
import TheResults from './components/TheResults.vue'
import TheAbsences from './components/TheAbsences.vue'
import TheAccount from './components/TheAccount.vue'
import TheLogin from './components/TheLogin.vue'
import TheReviews from './components/TheReviews.vue'

// const message = ref('hello from vue');
// const message2 = ref(data);

// fetch('/api/test').then(
// 	resp => resp.json()
// ).then(
// 	test => console.log(test)
// )

const isLoggedIn = ref("false");

const routes = {
    '#': {
        label: 'Schedule',
        component: TheSchedule,
    },
    '#notes': {
        label: 'Results',
        component: TheResults,
    },
    '#absences': {
        label: 'Absences',
        component: TheAbsences,
    },
    '#compte': {
        label: 'Account',
        component: TheAccount,
    },
    '#review': {
        label: 'Review',
        component: TheReviews,
    },
};

if (window.Laravel.isLoggedin) {
    this.isLoggedIn = true;
}

/**
 * Logs out the user.
 * 
 * @param mixed evt
 * 
 * @return void
 */
function logout(evt) {
    console.log("logout");
    evt.preventDefault();

    axios.get("/sanctum/csrf-cookie").then((response) => {

        axios.post("/api/logout").then((response) => {

            if (response.data.success) {
                window.location.href = "/";
            } else {
                console.log(response);
            }
        })
            .catch(function (error) {
                console.error(error);
            });
    });
}

const hash = ref(window.location.hash);
window.addEventListener('hashchange', () => hash.value = window.location.hash);
const curHash = computed(() => routes[hash.value] ? hash.value : Object.keys(routes)[0]);
const curComponent = computed(() => routes[curHash.value].component);
</script>


<template>
    <!-- <h1>
        {{ message }}
    </h1> -->
    <!-- <h2>
         {{message2}}
    </h2> -->
    <!-- for logged-in user-->
    <div v-if="isLoggedIn">
        <the-header :routes="routes" :curHash="curHash"></the-header>

        <main>
            <template v-for="(route, hash) of routes" :key="route">
                <div v-show="hash == curHash">
                    <component :is="curComponent" />
                </div>
            </template>
        </main>
    </div>
    <!-- for non-logged user-->
    <div v-else>
        <the-login></the-login>
    </div>
</template>

<style scoped>
* {
    /**
        * Colors
        */
    --orange: #F9A228;
    --green: #2A3A30;
    --beige: #F1DFCD;
    --white: #FFFCFA;

    /**
        * 
        */

}
</style>
<script setup>
    import { ref, computed } from 'vue';
    import { axiosClient } from './utils/axios';
    import { user } from './stores.js';
    //import { routes } from './routes.js';
    import router from './router/index.js';

    // const message = ref('hello from vue');
    // const message2 = ref(data);

    // fetch('/api/test').then(
    // 	resp => resp.json()
    // ).then(
    // 	test => console.log(test)
    // )

    // const hash = ref(window.location.hash);
    // window.addEventListener('hashchange', () => hash.value = window.location.hash);
    // const curHash = computed(() => routes[hash.value] ? hash.value : Object.keys(routes)[0]);
    // if (!user.token) window.location.hash = '#login';
    // const curComponent = computed(() => routes[curHash.value].component);

    /**
     * Logs out the user.
     * 
     * @param mixed evt
     * 
     * @return void
     */
    async function logout() {
        const {data} = await axiosClient.post("/api/logout")
        user.value = {
            id : null,
            firstName : '',
            lastName : '',
            token : ''
        }
        //window.location.hash = '#login'
    }
</script>


<template>
    <!-- <template v-for="(route, hash) of routes" :key="route">
      <div v-show="hash == curHash">
        <component :is="route.component"/>
      </div>
    </template> -->
        <router-view></router-view>
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
        * Fonts
        */

}
</style>
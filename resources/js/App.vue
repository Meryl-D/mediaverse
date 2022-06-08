<script setup>
    import { ref, computed } from 'vue';
    import { axiosClient } from './utils/axios';
    import { user } from './stores.js';
    import router from './router/index.js';


// const message = ref('hello from vue');
// const message2 = ref(data);

// fetch('/api/test').then(
// 	resp => resp.json()
// ).then(
// 	test => console.log(test)
// )

/**
 * Logs out the user.
 *
 * @param mixed evt
 *
 * @return void
 */
async function logout() {
  const { data } = await axiosClient.post("/api/logout");
  user.value = {
    id: null,
    firstName: "",
    lastName: "",
    token: "",
  };
}
</script>


<template>
        <Suspense><router-view></router-view></Suspense>
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
    --shadow: 0px 0px 10px 0px #FFCFAD;


    /**
    * Fonts
    */
    @font-face font-family: "SuisseScreen";
    src: local("SuisseScreen"),
    url(../fonts/SuisseScreen-Medium.otf) format("otf"),
    url(../fonts/SuisseScreen-Bold.otf) format("otf");

    background-color: var(--white);
}

:root {
    background-color : var(--white);
}
</style>
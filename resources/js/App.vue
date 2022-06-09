<script setup>
import { ref, computed } from "vue";
import { axiosClient } from "./utils/axios";
import { user } from "./stores.js";
import router from "./router/index.js";

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

<style>

@import url('https://fonts.googleapis.com/icon?family=Material+Icons');

* {
  /**
    * Colors
    */
  --orange: #f9a228;
  --green: #2a3a30;
  --beige: #f1dfcd;
  --white: #fffcfa;
  --shadow: 0px 0px 10px 0px #ffcfad;



  /**
    * Fonts
    */
  @font-face {
    font-family: "SuisseScreen";
    src: local("SuisseScreen"),
    url(../fonts/SuisseScreen-Medium.otf) format("otf"),
    url(../fonts/SuisseScreen-Bold.otf) format("otf");
  } 
  
}
.h1 {
  font-size: 2rem;
  color: var(--green);
}
.h2 {
  font-size: 1.3rem;
  color: var(--green);
}
.bignote {
  font-size: 1.5rem;
  color: var(--green);
}
.p {
  font-size: 1.1rem;
  color: var(--green);
}
.psmall {
  font-size: 1rem;
  color: var(--green);
}
.bold {
  font-weight: bold;
}


.DailyCourseBox{
    display: inline-block;
    background-color: #7f726a;
}
</style>
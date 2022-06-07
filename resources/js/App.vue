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
  <router-view></router-view>
</template>

<style scoped>
* {
  /**
        * Colors
        */
  --orange: #f9a228;
  --green: #2a3a30;
  --beige: #f1dfcd;
  --white: #fffcfa;

  /**
        * Fonts
        */
  @font-face font-family: "SuisseScreen";
  src: local("SuisseScreen"),
    url(../fonts/SuisseScreen-Medium.otf) format("otf"),
    url(../fonts/SuisseScreen-Bold.otf) format("otf");
}
</style>
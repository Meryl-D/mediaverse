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

//navigator.serviceWorker.register('/workerCacheFetched.js');
</script>


<template>
  <Suspense><router-view></router-view></Suspense>
</template>

<style>

@import url('https://fonts.googleapis.com/icon?family=Material+Icons');
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@500;700;900&display=swap');

* {
  margin: 0;
  padding: 0;
  font-family: 'Inter', sans-serif;
}

:root {
    /**
    * Colors
    */
  --orange: #f9a228;
  --green: #2a3a30;
  --beige: #f1dfcd;
  --white: #fffcfa;
  --red: #921b10;

  --shadow: 0px 0px 10px 0px #ffcfad;
  --small-radius: .6rem;
  --big-radius: 1.2rem;

  /** 
   * Sizes
   */
  --mobile-margins: 7vw;
}

#organiz {
  background-color: var(--white);
}

h1 {
  font-size: 2rem;
  font-weight: 700;
  color: var(--green);
}

h2 {
  font-size: 1.3rem;
  color: var(--green);
}

.bignote {
  font-size: 1.1rem;
  color: var(--green);
}

p {
  font-size: .8rem;
  color: var(--green);
}

.psmall {
  font-size: .5rem;
  color: var(--green);
}

.bold {
  font-weight: 700;
}

.DailyCourseBox {
    display: inline-block;
    background-color: #7f726a;
}

.error {
  color: var(--red);
  margin: 0;
}

@media (min-width: 576px) {
  p {
    font-size: .85rem;
  }
}

@media (min-width: 992px) {
  p {
    font-size: .9rem;
  }
}
</style>
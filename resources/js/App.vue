<script setup>
import { ref, computed, watchEffect, onMounted } from "vue";
import { axiosClient } from "./utils/axios";
import { user, isMobile } from "./stores.js";
import router from "./router/index.js";
import { useWindowSize } from "vue-window-size";

const { width, height } = useWindowSize();

watchEffect(() => {
  if (width.value < 992) {
    isMobile.value = true;
  } else {
    isMobile.value = false;
  }
});

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
@import url("https://fonts.googleapis.com/icon?family=Material+Icons");
@import url("https://fonts.googleapis.com/css2?family=Inter:wght@500;700;900&display=swap");

* {
  margin: 0;
  padding: 0;
  font-family: "Inter", sans-serif;
}

:root {
  /**
    * Colors
    */
  --orange: #f9a228;
  --green: #2a3a30;
  --beige: #E3CEC2;
  --beige-transp: rgba(227, 206, 194, 0.5);
  --brown: #645C4E;
  --white: #fffcfa;
  --red: #921b10;

  --shadow: 0px 0px 10px 0px #ffcfad;
  --small-radius: 0.6rem;
  --big-radius: 1.2rem;

  /** 
   * Sizes
   */
  --mobile-margins: 7vw;
}

#organiz {
  background-color: var(--white);
  /* width: 100vw; */
  min-height: 100vh;
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
  font-size: 0.8rem;
  color: var(--green);
}

.psmall {
  font-size: 0.5rem;
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
.mainTitle {
  display: flex;
  flex-direction: column;
}
.pLink {
  display: inline;
  text-decoration: underline;
  text-underline-offset: 2px;
  opacity: 75%;
  cursor: pointer;
}
.sLink {
  display: inline;
  opacity: 75%;
  cursor: pointer;
}
.mainIcone {
  display: flex;
  flex-direction: row;
}

@media (min-width: 576px) {
  p {
    font-size: 0.85rem;
  }
}

@media (min-width: 992px) {
  p {
    font-size: 0.9rem;
  }
}
  .titleMobile {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    margin-bottom: 0.3rem;
    width: 95vw;
  }
  .switch {
    color: var(--orange);
    background-color:var(--white) ;
    justify-content: flex-end;
    border: none;
  }
  .go-back {
  color: var(--green);
  background-color: var(--white);
  border: none;
}
.daily-nav {
  display: flex;
  justify-content: space-between;
  width: 90%;
  padding: 2rem 0;
  align-items: center;
}
</style>
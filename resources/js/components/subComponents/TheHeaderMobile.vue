<script setup>
import { ref } from 'vue'




const isActive = ref(false);

function test() {

  console.log("222")
  isActive.value = !isActive.value;

}





</script>

<template>
  <div>
    <div v-if="!isActive" class="menuBurger" @click="test()">
      <span class="material-icons">menu</span>
      <span>
        <link
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
      </span>
    </div>


    <div v-if="isActive" class="menu">
      <div v-if="isActive" class="close" @click="test()">
        <span class="material-icons">close</span>
        <span>
          <link
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        </span>
      </div>

    </div>
  </div>
</template>

<style scoped>
@import url("https://fonts.googleapis.com/icon?family=Material+Icons");



.menuBurger {

  cursor: pointer;
}

.close {

  cursor: pointer;
}


.menu {
  width: 100vw;
  height: 100vw;
  background-color: red;


}
</style>
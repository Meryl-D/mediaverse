<script setup>
</script>

<template>
  <div>
    <!-- insérer le contenu du parent -->
    <slot></slot>
  </div>
</template>

<style scoped>
div {
  display: flex;
  justify-content: center;
  background-color: var(--white);
  border: none;
  border-radius: var(--big-radius);
  flex-wrap: wrap;
  box-shadow: var(--shadow);
  width: 86vw;
  max-width: 600px;
}

@media (min-width: 992px) {
    div {
        box-shadow: none;
        border-radius: 0;
        width: 96%;
        max-width: 1000px; 
    }
}
</style>
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
  background-color: var(--white);
  border: none;
  border-radius: 0.3em;
  box-shadow: var(--shadow);
}
</style>